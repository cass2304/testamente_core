<?php

namespace App\Http\Controllers;
/*------ USE de JWT: Inicio-------- */
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/*------  USE de JWT: Fin -------- */

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\personal_information;
use App\documents;


class personalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function register(Request $request) {

        // Obtenemos los datos del token
        $token = $request->header('token');

       if ($user = JWTAuth::toUser($token))
       {
           // Se crean los registros en la tabla de informacion personal
           $user_id = $user->id;
           $newPersonal_information = array(
              'full_name'=> $request->input('full_name'),
              'birth_date' => $request->input('birth_date'),
              'birth_place' => $request->input('birth_place'),
              'genero' => $request->input('genero'),
              'nationality' => $request->input('nationality'),
              'profession' => $request->input('profession'),
              'address' => $request->input('domicilio'),
              'mother_name' => $request->input('mother_name'),
              'father_name' => $request->input('father_name'),
              'identity card' => $request->input('identity card'),
              'user_id' => $user_id,


           );
          $information = personal_information::create($newPersonal_information);

           // Se Guarda el registro en la BD
           $id = $request->input('id_documents');
           // Se le solicita al usuario el correo electronico y luego se buscan los demas registros en la BD
           $Findstep = documents::find($id);
           $tep ="3";

           // Se verifica si el email existe en la BD
            if ($Findstep!=null) {

           // Si el email existe se actualiza el campo del password para ese usuario
           $Findstep->update(['step' =>($tep)]);

           // Se guarda el registro en la BD
           $Findstep->save();
             }
           return response()->json(["Datos Cargados Correctamente"]);
           // Si hay un error
           return response()->json(["Error"]);

        }  // Cierre del if del token

     }

    public function show(Request $request)
    {
      // Obtenemos los datos del token
      $token = $request->header('token');

      if ($user = JWTAuth::toUser($token))
      {

      // Se Recibe el user_id del registro
      $ShowRegistro = personal_information::where("user_id", "=", $request->get("user_id"))->first();

      // Muestra el registro segun el user_id
      return $ShowRegistro;
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
}
