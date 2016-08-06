<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\documents;

class documentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
          // Obtenemos los datos del Login
         $credentials = $request->only('email', 'password');
         $token = null;

         // Se verifica si hay un token
          if ($token = JWTAuth::attempt($credentials))
           {
               // Si las credenciales existen Retorna un Json con la lista de usuarios del modelo User
               return response()->json(documents::all());
           }

           //  Si no existen las credenciales se muestra un error
               return response()->json(['error' => 'Usuario o Clave invalidos'], 401);
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
    public function update(Request $request)
    {
        $userid = $request->get('user_id');
        $Findstep = documents::where('user_id', $userid )->first();
        // Se verifica si el email existe en la BD
         if ($Findstep!=null) {

        // Si el email existe se actualiza el campo del password para ese usuario
            $Findstep->update(['step' => ($request->get("step"))]);

        // Se guarda el registro en la BD
            $Findstep->save();

        // Retorna un Json con el usuario que actualizo el password

            return response()->json('OK, Next Step update');

         }


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
