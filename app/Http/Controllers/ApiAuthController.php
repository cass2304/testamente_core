<?php

namespace App\Http\Controllers;
/*------ USE de JWT: Inicio-------- */
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/*------  USE de JWT: Fin -------- */

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class ApiAuthController extends Controller
{

    // Autenticacion de Usuario (Creacion de Token)

    public function userAuth(Request $request) {
        $credentials = $request->only('email', 'password');
        $token = null;

        try {
            // Se verifica las credenciales
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Usuario o Clave Invalidos'], 401);
            }
        } catch (JWTException $e) {
            // Si hay un error
            return response()->json(['error' => 'No se pudo crear el Token'], 500);
        }

        // Si todo va bien retorna el token
        return response()->json(compact('token'));
    }


    // Registro de Usuarios

    public function register(Request $request) {

        // Se crea la variable de nuevo usuario
        $newUser = User::create ($request->all());

        // Se encripta el Password
        $newUser->password = bcrypt($request->password);

        // Se Guarda el registro en la BD
        $newUser->save();

        // Verificamos que se haya credo el usuario
        if ($newUser->save()) {
          return response()->json(["Usuario Creado Correctamente"]);
        }
        // Si hay un error
        return response()->json(["no pudo ser creado el usuario"]);


    }

    // Cambio de contraseña

    public function NewPasswd(Request $request) {

       // Se le solicita al usuario el correo electronico y luego se buscan los demas registros en la BD
       $FindUser = User::where("email", "=", $request->input("email"))->first();

       // Se verifica si el email existe en la BD
        if ($FindUser!=null) {

       // Si el email existe se actualiza el campo del password para ese usuario
           $FindUser->update(['password' => bcrypt($request->input("password"))]);

       // Se guarda el registro en la BD
           $FindUser->save();

       // Retorna un Json con el usuario que actualizo el password
           return response()->json($FindUser);
        }

    }

   // Eliminar registro

    public function delete(Request $request) {

       // Se Recibe el id del registro
       $deleteUser = User::where("id", "=", $request->get("id"))->first();

       // Se Elimina el registro de la BD
       $deleteUser->delete();

       // Retorna un Json con el usuario que actualizo el password
       return response()->json('Registro Eliminado Satisfactoriamente');


    }

    public function index(Request $request)
    {
         // Obtenemos los datos del Login
        $credentials = $request->only('email', 'password');
        $token = null;

        // Se verifica si hay un token
         if ($token = JWTAuth::attempt($credentials))
          {
              // Si las credenciales existen Retorna un Json con la lista de usuarios del modelo User
              return response()->json(User::all());
          }

          //  Si no existen las credenciales se muestra un error
              return response()->json(['error' => 'Usuario o Clave invalidos'], 401);
    }

}
