<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class beneficiary extends Model
{

  protected $table = 'beneficiary';

  protected $fillable = ['description', 'nro_finca', 'nro_folio','nro_libro','adress','user_id' ];

  public function property(){
    return $this->hasMany('\App\property');
  }
  public function User(){
    return $this->belongsTo('\App\User');
  }
}
