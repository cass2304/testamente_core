<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\personal_information;

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
           $newPersonal_information = personal_information::create ($request->all());

           // Se Guarda el registro en la BD
           $newPersonal_information->save();

           // Verificamos que se haya credo el usuario
           if ($newPersonal_information->save()) {
             return response()->json(["Datos Creados Correctamente"]);
           }
           // Si hay un error
           return response()->json(["Error"]);

         }

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
