<?php

namespace App\Http\Controllers;

/*------ USE de JWT: Inicio-------- */
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/*------  USE de JWT: Fin -------- */

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\property;
use App\beneficiary;

class propertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($user = JWTAuth::parseToken()->authenticate()){

            $property_info = array(
                'home' => $request->input('home'),
                'account_bank' => $request->input('account_bank'),
                'pension_plan' => $request->input('pension_plan'),
                'account_inversion'=> $request->input('account_inversion'),
                'healthcare'=> $request->input('healthcare')
            );

            if($property_info['home'] === 'si'){

                $address = array();

                $address = $request->input('addres_home');

                if(is_array($address) && sizeof($address) > 0){
                    foreach($address as $homes ){

                        $home_property = new property();
                        $home_property->description = 'HOME';
                        $home_property->nro_finca = $homes['nro_finca'];
                        $home_property->nro_folio = $homes['nro_folio'];
                        $home_property->nro_libro = $homes['nro_libro'];
                        $home_property->user_id = $user->id;

                        if(!$home_property->save()){

                            return response()->json(["Error saving homes"]);
                        }
                    }
                }

            }

            if($property_info['account_bank'] === 'si'){

                $bank = $request->input('account_bank_beneficiary');

                if(is_array($bank) && sizeof($bank) > 0){
                    foreach($bank as $banks ){

                        $bank_beneficiary = new beneficiary();
                        $bank_beneficiary->firts_name = $banks['fullname'];
                        $bank_beneficiary->percentage = $banks['percentage'];
                        $bank_beneficiary->user_id = $user->id;


                        if($bank_beneficiary->save()){

                            $bank_property = new property();

                            $bank_property->description = 'ACCOUNT_BANK';
                            $bank_property->user_id = $user->id;
                            $bank_property->beneficiary->id = $bank_beneficiary->id;

                            $bank_property->save();

                        }else{
                            return response()->json(["Error saving Accounts"]);
                        }
                    }
                }else{

                    $bank_property = new property();
                    $bank_property->descripyion = 'ACCOUNT_BANK';
                    $bank_property->user_id = $user->id;

                    if(!$bank_property->save()){
                        return response()->json(["Error saving only account"]);
                    }
                }

            }

            if($property_info['pension_plan'] === 'si'){

                $pension_plan = $request->input('pension_plan_beneficiary');

                if(is_array($pension_plan) && sizeof($pension_plan) > 0){
                    foreach($pension_plan as $pension_plans ){

                        $plan_beneficiary = new beneficiary();
                        $plan_beneficiary->firts_name = $pension_plans['fullname'];
                        $plan_beneficiary->percentage = $pension_plans['percentage'];
                        $plan_beneficiary->user_id = $user->id;


                        if($plan_beneficiary->save()){

                            $bank_property = new property();

                            $bank_property->description = 'ACCOUNT_BANK';
                            $bank_property->user_id = $user->id;
                            $bank_property->beneficiary->id = $plan_beneficiary->id;

                            $bank_property->save();

                        }else{
                            return response()->json(["Error saving Accounts"]);
                        }
                    }
                }else{

                    $bank_property = new property();
                    $bank_property->descripyion = 'ACCOUNT_BANK';
                    $bank_property->user_id = $user->id;

                    if(!$bank_property->save()){
                        return response()->json(["Error saving only account"]);
                    }
                }
            }

            if($property_info['account_inversion'] === 'si'){

                $inversion = new property();
                $inversion->description = 'ACCOUNT_INVERSION';
                $inversion->user_id = $user->id;

                if(!$bank_property->save()){
                    return response()->json(["Error saving only account"]);
                }
            }

            if($property_info['healthcare'] === 'si'){

                $inversion = new property();
                $inversion->description = 'HEALTHCARE';
                $inversion->user_id = $user->id;

                if(!$bank_property->save()){
                    return response()->json(["Error saving only account"]);
                }
            }

            return response()->json(['ON']);

        }
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
