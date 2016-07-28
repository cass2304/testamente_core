<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class location extends Model
{
  protected $table = 'location';

  protected $fillable = ['pais', 'moneda', 'formulario_path','user_id' ];

  public function User(){
    return $this->belongsTo('\App\User');
  }
}
