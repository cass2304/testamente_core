<?php

namespace App\Http\Controllers;
/*------ USE de JWT: Inicio-------- */
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/*------  USE de JWT: Fin -------- */

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\family_information;

class familyController extends Controller
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
        $edo_civil = $request->input('edo_civil');
        $hijos = $request->input('hijos');

        $FindUser = personal_information::find($user_id);

        // Se verifica si el email existe en la BD
         if ($FindUser!=null) {

        // Si el email existe se actualiza el campo del password para ese usuario
        $FindUser->update(['civil_status' =>($edo_civil)]);

        // Se guarda el registro en la BD
         $FindUser->save();
          {
        if ($edo_civil=="casado"){
          $newFamily_information = array(
             'mate_name'=> $request->input('mate_name'),
             'imu_data' => $request->input('imu_data'),
             'regimen' => $request->input('regimen'),
             'renap_data' => $request->input('renap_data'),
             'user_id' => $user_id
          );

            $information = family_information::create($newFamily_information);
          }

          if ($hijos=="si"){
            $FindFamily = family_information::find($user_id);
            $child_name => $request->input('child_name'),
            $child_birthdate => $request->input('child_birthdate'),
            $child_nationality => $request->input('child_nationality'),
            $child_placebirth => $request->input('child_placebirth'),

            $FindFamily->update(['child_name' =>($child_name)]);
            $FindFamily->update(['child_birthdate' =>($child_birthdate)]);
            $FindFamily->update(['child_nationality' =>($child_nationality)]);
            $FindFamily->update(['child_placebirth' =>($child_placebirth)]);

            $FindFamily->save();
          }
          $id = $request->input('id_documents');
          // Se le solicita al usuario el correo electronico y luego se buscan los demas registros en la BD
          $Findstep = documents::find($id);
          $tep ="4";

          // Se verifica si el email existe en la BD
           if ($Findstep!=null) {

          // Si el email existe se actualiza el campo del password para ese usuario
          $Findstep->update(['step' =>($tep)]);

          // Se guarda el registro en la BD
          $Findstep->save();
           return response()->json(["Datos Cargados Correctamente"]);

     }

    }

    public function show(Request $request)
    {
      // Obtenemos los datos del token
      $token = $request->header('token');

      if ($user = JWTAuth::toUser($token))
      {
        // Se Recibe el user_id del registro
        $ShowRegistro = family_information::where("user_id", "=", $request->get("user_id"))->first();

        // Muestra el registro segun el user_id
        return $ShowRegistro;
      }
    }

    public function destroy(Request $request) {
      // Obtenemos los datos del token
      $token = $request->header('token');

      if ($user = JWTAuth::toUser($token))
      {
         // Se Recibe el id del registro
         $deleteRegistro = family_information::where("user_id", "=", $request->get("user_id"))->first();

         // Se Elimina el registro de la BD
         $deleteRegistro->delete();

         // Retorna un Json
         return response()->json('Registro Eliminado Satisfactoriamente');
       }
    }

    public function update(Request $request)
    {
      $token = $request->header('token');

      if ($user = JWTAuth::toUser($token))
      {
        $userid = $request->get('user_id');

        $family_information = family_information::where('user_id', $userid )->first();

        // Se verifica si el user_id existe en la tabla

         if ($family_information!=null) {

        // Si el email existe se actualiza el campo del password para ese usuario
            $family_information->update($request->all());

        // Se guarda el registro en la BD
            $family_information->save();

        // Retorna un Json

            return response()->json('OK, Registro Update');
    }
      }
    }




}
