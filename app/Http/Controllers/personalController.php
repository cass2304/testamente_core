<?php

namespace App\Http\Controllers;
/*------ USE de JWT: Inicio-------- */
use App\Pregunta;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/*------  USE de JWT: Fin -------- */

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\personal_information;
use App\Document;
use App\Respuesta;
use App\RespuestaDetalle;
use App\RespuestaHijos;
use App\RespuestaActivos;
use App\RespuestaFinanciero;
use App\RespuestaPropiedad;
use DB;


class personalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        // Obtenemos los datos del token
        $token = $request->header('Authorization');


        $user = JWTAuth::parseToken()
            ->authenticate()
            ->join('tbl_documents','tbl_users.id','=','tbl_documents.user_id')
            ->find(JWTAuth::parseToken()->authenticate()->id);

        if(count($user->toArray()) == 0){
            return response()->json(["Error"],401);
        }


        foreach ($request->all() as $answer){

            $answerToSave = new Respuesta();

            $answerToSave->ID_documento = $user['document_id'];
            $answerToSave->ID_pregunta = $answer['ID'];
            $answerToSave->respuesta = $answer['respuesta'];

            if(!$answerToSave->save()){
                return response()->json(["Error_saving_detail"],401);
            }


            switch(intval($user['step'])){

                case 3:

                    if(count($answer['detalle'])>0){

                        foreach($answer['detalle'] as $detalle){

                            $detail = new RespuestaHijos();
                            $detail->ID_documento = $user['document_id'];
                            $detail->nombre =  $detalle['nombre'];
                            $detail->genero = $detalle['genero'];
                            $detail->fecha_nacimiento = $detalle['fecha_nacimiento'];
                            $detail->lugar = $detalle['lugar'];
                            $detail->departamento = $detalle['departamento'];
                            $detail->inscripcion_renap = $detalle['inscripcion_renap'];
                            $detail->nose_renap = $detalle['nose_renap'];

                            if(!$detail->save()){
                                return response()->json(["Error_saving_detail"],401);
                            }

                        }
                    }
                break;

                case 4:

                    if(isset($answer['propiedad'])){

                        foreach($answer['propiedad'] as $detalle){

                            $detail = new RespuestaPropiedad();
                            $detail->ID_documento = $user['document_id'];
                            $detail->pais =  $detalle['pais'];
                            $detail->domicilio = $detalle['domicilio'];
                            $detail->nro_finca = $detalle['nro_finca'];
                            $detail->nro_folio = $detalle['nro_folio'];
                            $detail->nro_libro = $detalle['nro_libro'];

                            if(!$detail->save()){
                                return response()->json(["Error_saving_detail_propiedad"],401);
                            }

                        }
                    }

                    if(isset($answer['financiero'])){

                        foreach($answer['financiero'] as $detalle){

                            $detail = new RespuestaFinanciero();
                            $detail->ID_documento = $user['document_id'];
                            $detail->producto_financiero = $detalle['producto_financiero'];
                            $detail->tiene_beneficiario =  $detalle['tiene_beneficiario'];
                            $detail->porcentaje = $detalle['porcentaje'];
                            $detail->cambiar_beneficiario = $detalle['cambiar_beneficiario'];
                            $detail->beneficiario = $detalle['beneficiario'];

                            if(!$detail->save()){
                                return response()->json(["Error_saving_detail_propiedad"],401);
                            }

                        }
                    }
                break;

                case 5:

                    if(count($answer['detalle'])>0){

                        foreach($answer['detalle'] as $detalle){

                            $detail = new RespuestaActivos();
                            $detail->ID_documento = $user['document_id'];
                            $detail->activo =  $detalle['activo'];
                            $detail->monto = $detalle['monto'];
                            $detail->beneficiario = $detalle['beneficiario'];
                            $detail->porcentaje = $detalle['porcentaje'];

                            if(!$detail->save()){
                                return response()->json(["Error_saving_detail_propiedad"],401);
                            }

                        }
                    }
                break;

                default:

                    if(count($answer['detalle'])>0){
                        foreach($answer['detalle'] as $detalle){

                            $detail = new RespuestaDetalle();
                            $detail->ID_respuesta = $answerToSave->ID;
                            $detail->label =  $detalle['label'];
                            $detail->respuesta = $detalle['value'];

                            if(!$detail->save()){
                                return response()->json(["Error_saving_detail"],401);
                            }

                        }
                    }
                break;
            }

        }

        $updateStep = Document::find($user['document_id']);

        if(!$updateStep){
            return response()->json(['error' => 'not_found_document'], 401);
        }

        $step = $user['step'] + 1;

        $updateStep->update(['step' =>($step)]);

        $updateStep->save();

        return response()->json('Next_step');

    }

    public function getQuestions(Request $request)
    {
        if(!$user = JWTAuth::parseToken()->authenticate()){
            return response()->json(["Error"]);
        }

        if(!$request->step || !$request->user_id){
            return response()->json(['error' => 'user_id or step is required'], 401);
        }

        $getInfo = Pregunta::where('paso','=',$request->step)->get();

        $response = array();

        if($getInfo){

            foreach ($getInfo as $value){

                //var_dump($value['nro_pregunta']);

               /* $answer = array(
                    'pregunta' => $value['nro_pregunta'],
                    'detalle' => array(
                        'ID' => $value['ID'],
                        'sub_pregunta'=> $value['sub_pregunta']
                    )
                );
                array_push($response, $answer);*/

                //-------------------------
                if($value['sub_pregunta']== null) $value['sub_pregunta'] = 0;
                if(!isset($response[$value['nro_pregunta']])) $response[$value['nro_pregunta']] = array();
                $objTMP = array('ID' => $value['ID'],
                    'sub_pregunta'=> $value['sub_pregunta']);

                array_push($response[$value['nro_pregunta']], $objTMP);


            }

            return response()->json($response);

        }

    }

    public function update(Request $request, $id)
    {
        // Obtenemos los datos del token
        $token = $request->header('token');

        if ($user = JWTAuth::toUser($token))
        {
            // Se Recibe el id del registro
            $updateRegistro = personal_information::find($id);

            // Se actualiza el registro
            $updateRegistro->fill($request->all());

            $updateRegistro->save();

            return response()->json('Registro Actualizado Satisfactoriamente');
        }
    }

    public function getDocument(Request $request) {


        $user = JWTAuth::parseToken()
            ->authenticate()
            ->join('tbl_documents','tbl_users.id','=','tbl_documents.user_id')
            ->find(JWTAuth::parseToken()->authenticate()->id);


        $user->toArray();

        if(count($user->toArray()) == 0){
            return response()->json(["Error"],401);
        }

        //die(var_dump($user->document_id));

        //fill  part one
        $data_1 = DB::select('SELECT A.pregunta, B.respuesta
                                From tbl_preguntas A
                                LEFT JOIN tbl_respuestas B on A.ID = B.ID_pregunta AND B.ID_documento ='. $user->document_id .'
                                WHERE A.paso = 2');

        $respuesta1 = array();

        //die(var_dump(is_array($data_1)));

        foreach ($data_1  as $otorgante){
            //if(!isset($respuesta1[$otorgante->pregunta])) $respuesta1[$otorgante->pregunta] = $otorgante->respuesta;

            if($otorgante->pregunta === 'Nombres y apellidos completos'){
                $respuesta1['Nombres']= $otorgante->respuesta;
            }

            if($otorgante->pregunta  === 'Fecha de nacimiento' ){
                $respuesta1['Edad'] = $otorgante->respuesta == null ? '0':$this->CalculaEdad($otorgante->respuesta);
                $tmpNac = $otorgante->respuesta;
            }

            if($otorgante->pregunta  === 'Nacionalidad'){
                $respuesta1['Nacionalidad'] = $otorgante->respuesta;
            }

            if($otorgante->pregunta  === 'Profesión y oficio'){
                $respuesta1['Profesión y oficio'] = $otorgante->respuesta;
            }

            if($otorgante->pregunta  === 'Domicilio'){
                $respuesta1['Domicilio'] = $otorgante->respuesta;
            }

            if($otorgante->pregunta  === 'Documento de identificación'){
                $respuesta1['Documento de identificación'] = $otorgante->respuesta;
            }

            if($otorgante->pregunta === 'Nombre del padre'){
                $tmpPadre = $otorgante->respuesta;
            }

            if($otorgante->pregunta === 'Nombre de la madre'){
                $tmpMadre = $otorgante->respuesta;
            }

            if($otorgante->pregunta === 'Lugar de nacimiento'){
                $tmpLg = $otorgante->respuesta;
            }

        }
        //fill part two

        $respuesta2 = array('Nacimiento' => array(
            'Fecha de nacimiento' => $tmpNac,
            'Lugar de nacimiento' => $tmpLg,
            'Nombre de la madre' => $tmpMadre,
            'Nombre del padre' =>$tmpPadre
        ),'Estado civil' => array(), 'Hijos' => array());

        $data_2 = DB::select('SELECT A.*,B.respuesta, C.label, C.respuesta as destalle
                              From tbl_preguntas A
                                LEFT JOIN tbl_respuestas B on A.ID = B.ID_pregunta AND B.ID_documento ='. $user->document_id .'
                                LEFT JOIN tbl_respuesta_detalle C on B.ID = C.ID_respuesta
                                WHERE A.paso = 3');

        foreach( $data_2 as $datos){
            if(!isset($fill[$datos->pregunta])) $fill[$datos->pregunta] = $datos->respuesta;

            if($datos->pregunta =='¿Tienes hijos?'){
                if($datos->respuesta === 'Si'){
                   $hijos = RespuestaHijos::where('ID_documento','=',$user->document_id)->get();
                    array_push($fill,$hijos->toArray());

                }
            }
        }

        array_push($respuesta2['Estado civil'],$fill );

        return response()->json($response = array('Otorgante' => $respuesta1, 'Informacion personal' => $respuesta2));
    }


    public function destroy(Request $request) {
        // Obtenemos los datos del token
        $token = $request->header('token');

        if ($user = JWTAuth::toUser($token))
        {
            // Se Recibe el id del registro
            $deleteRegistro = personal_information::where("user_id", "=", $request->get("user_id"))->first();

            // Se Elimina el registro de la BD
            $deleteRegistro->delete();

            // Retorna un Json
            return response()->json('Registro Eliminado Satisfactoriamente');

        }
    }

    function CalculaEdad( $fecha ) {
        die(var_dump($fecha));
        list($Y,$m,$d) = explode("-",$fecha);
        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }
}
