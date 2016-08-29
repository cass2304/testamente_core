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
use App\documents;
use Illuminate\Support\Facades\Crypt;
use Hash;


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
        //return response()->json(compact('token'));
        $ShowRegistro = User::where("email", "=", $request->get("email"))->first();
        $user_id 	= array(


           'user_id' => $ShowRegistro->id
        );
        $Findstep = documents::where('user_id', $user_id )->first();
        // Se verifica si el email existe en la BD
        if ($Findstep!=null) {

          return response()->json([
                  'user_id' => $ShowRegistro->id,
                  'nombre' => $ShowRegistro->name,
                  'email' => $ShowRegistro->email,
                  'id_documents' => $Findstep->id,
                  'step_id' => $Findstep->step,
                  'token' => $token
              ]);
        }
  }

    // Registro de Usuarios

    public function register(Request $request) {
      $password = Hash::make($request->input('password'));
      $credentials = array(
         'name' => $request->input('name'),
         'email' => $request->input('email'),
         'password' => $password,
      );

      $email 	= array(

         'email' => $request->input('email'),

      );
      $Findemail = User::where('email', $email )->first();
      if ($Findemail) {
          return response()->json(['error' => 'EL Usuario ya esta rgistrado.'], 401);
      }
      $user = User::create($credentials);
      $email 	= array(

         'email' => $request->input('email'),

      );
      $Findstep = User::where('email', $email )->first();
      // Se verifica si el email existe en la BD
       if ($Findstep!=null) {
          $step = "1";
      // Se llena la tabla documents con los primeros registros
      $Documents = new documents;
      $Documents ->user_id = $Findstep->id;
      $Documents ->step = $step;

      $Documents->save();
      $token = JWTAuth::fromUser($user);
      return response()->json([

              'user_id' => $Findstep->id,
              'nombre' => $Findstep->name,
              'email' => $Findstep->email,
              'id_documents' => $Documents->id,
              'token' => $token
        ]);



  }
      }

    // Cambio de contraseña

      public function NewPasswd(Request $request) {

        $token = $request->header('token');

        if ($user = JWTAuth::toUser($token))

         {
            $email= $request->input("email");
           // Se le solicita al usuario el correo electronico y luego se buscan los demas registros en la BD
           $FindUser = User::where("email", "=", $email )->first();

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
