<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class property extends Model
{
  protected $table = 'property';

  protected $fillable = ['first_name', 'last_name', 'birth_place','nationality','profession','address','civil_status','mother_name','father_name','identity card','user_id' ];


  public function User(){
    return $this->belongsToMany('\App\User');

  	}

    public function beneficiary(){
      return $this->belongsToMany('\App\beneficiary');

    	}
}
