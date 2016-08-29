<?php

namespace App\Http\Controllers;
/*------ USE de JWT: Inicio-------- */
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/*------  USE de JWT: Fin -------- */
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\aditional_questions;
use App\aditional_questions_detail;
use App\documents;
use Validator;
use Illuminate\Database\QueryException;

class aditionalQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function register(Request $request) {
       $validator = Validator::make($request->all(), [
           'id_documents' => 'required|integer'
       ]);
       if ($validator->fails()) {
           return response()->json($validator->messages(), 402);
       }

       $user = JWTAuth::parseToken()->authenticate();
           $step="1";
           $id_documents=$request->get('id_documents');

           $q2=$request->get('question2');
           $q3=$request->get('question3');
           $q4=$request->get('question4');
           $q5=$request->get('question5');
           $q6=$request->get('question6');
           $q7=$request->get('question7');
           try{
             $aditional_questions = array(
               ['nro_questions' => '1', 'questions' => '¿Estas llenando este formulario con la ayuda de alquien mas?', 'answer' =>$request->input('question1'),'step' => $step,'id_documents' => $id_documents],
               ['nro_questions' => '2', 'questions' => '¿Sabes leer y escribir?', 'answer' => $q2,'step' => $step,'id_documents' => $id_documents],
               ['nro_questions' => '3', 'questions' => '¿Tienes alguna discapacidad que te impida ver?', 'answer' => $q3,'step' => $step,'id_documents' => $id_documents],
               ['nro_questions' => '4', 'questions' => '¿Estas en el libre ejercicio de tus derechos?', 'answer' => $q4,'step' => $step,'id_documents' => $id_documents],
               ['nro_questions' => '5', 'questions' => '¿Te encuentras en pleno uso de tus capacidades mentales?', 'answer' => $q5,'step' => $step,'id_documents' => $id_documents],
               ['nro_questions' => '6', 'questions' => '¿Alguna vez haz otorgado un testamento?', 'answer' => $q6,'step' => $step,'id_documents' => $id_documents],
               ['nro_questions' => '7', 'questions' => '¿Puedes o sabes firmar?', 'answer' => $q7,'step' => $step,'id_documents' => $id_documents],
                  );
                // Loop through each user above and create the record for them in the database
                foreach ($aditional_questions as $aditional_question)
                {
                    aditional_questions::create($aditional_question);
                }

                $question1= "¿Estas llenando este formulario con la ayuda de alquien mas?";
                $Find_question1 = aditional_questions::where('questions', $question1 )->first();
                // Se verifica si el email existe en la BD
                $answer = $Find_question1->answer;
                if ($answer=="si") {
                  $id_aditional = $Find_question1->id;
                  $label = "Nombre de la persona";
                  $detail = new aditional_questions_detail;
                  $detail ->id_aditional = $id_aditional;
                  $detail ->label = $label;
                  $detail ->value = $request->input('name');

                  $detail->save();

                  }

                  $question= "¿Sabes leer y escribir?";
                  $Find_question2 = aditional_questions::where('questions', $question )->first();
                  // Se verifica si el email existe en la BD
                  $answer = $Find_question2->answer;
                  if ($answer=="no") {
                    $id_aditional2 = $Find_question2->id;
                    $detail = new aditional_questions_detail;
                    $detail ->id_aditional = $id_aditional2;
                    $detail ->label = $request->input('name_1');
                    $detail ->value = $request->input('tlf');

                    $detail->save();

                    }

                    $question= "¿Tienes alguna discapacidad que te impida ver?";
                    $Find_question3 = aditional_questions::where('questions', $question )->first();
                    // Se verifica si el email existe en la BD
                    $answer = $Find_question3->answer;
                    if ($answer=="si") {
                      $id_aditional3 = $Find_question3->id;
                      $detail = new aditional_questions_detail;
                      $detail ->id_aditional = $id_aditional3;
                      $detail ->label = $request->input('name_2');
                      $detail ->value = $request->input('tlf_1');

                      $detail->save();

                      }


                    $question= "¿Alguna vez haz otorgado un testamento?";
                    $Find_question6 = aditional_questions::where('questions', $question )->first();
                    // Se verifica si el email existe en la BD
                    $answer = $Find_question6->answer;
                      if ($answer=="si") {
                        $id_aditional6 = $Find_question6->id;
                        $label = "Describir";
                        $detail = new aditional_questions_detail;
                        $detail ->id_aditional = $id_aditional6;
                        $detail ->label = $label;
                        $detail ->value = $request->input('descripcion');

                        $detail->save();

                        }

                        $question= "¿Puedes o sabes firmar?";
                        $Find_question7 = aditional_questions::where('questions', $question )->first();
                        // Se verifica si el email existe en la BD
                        $answer = $Find_question7->answer;
                          if ($answer=="no") {
                            $id_aditional7 = $Find_question7->id;
                            $label = "necesito un testigo";
                            $detail = new aditional_questions_detail;
                            $detail ->id_aditional = $id_aditional7;
                            $detail ->label = $label;
                            $detail ->value = $request->input('descripcion_1');

                            $detail->save();

                            }
                            $id = $request->input('id_documents');
                            // Se le solicita al usuario el correo electronico y luego se buscan los demas registros en la BD
                            $Findstep = documents::find($id);
                            $tep ="2";

                            // Se verifica si el email existe en la BD
                             if ($Findstep!=null) {

                            // Si el email existe se actualiza el campo del password para ese usuario
                            $Findstep->update(['step' =>($tep)]);

                            // Se guarda el registro en la BD
                            $Findstep->save();
                              }
                  return response()->json(["Datos Cargados Correctamente"]);
           }catch(QueryException $e){
             return response()->json([
               'error' => 'error in database',
               'e' => $e
             ],402)
           }
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
