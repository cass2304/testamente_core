<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class personal_information extends Model
{
  protected $table = 'personal_information';

  protected $fillable = ['full_name', 'birth_date', 'birth_place','genero','nationality','profession','address','civil_status','mother_name','father_name','identity card','user_id' ];

  public function User(){
    return $this->belongsTo('\App\User');
  }

}
