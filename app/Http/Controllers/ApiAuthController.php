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
            if (! $token = JWTAuth::attempt($credentials)) {
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
        $newUser = new User($request->all());
        $newUser->password = bcrypt($request->password); // Se encripta el Password
        $newUser->save();

        // Verificamos que se haya credo el usuario
        if ($newUser->save()) {
          return response()->json(["Usuario Creado Correctamente"]);  
        }
        // Si hay un error
        return response()->json(["no pudo ser creado el usuario"]);


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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    
     
    
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
