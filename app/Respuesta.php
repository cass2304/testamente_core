<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
  protected $table = 'tbl_respuestas';
  protected $primaryKey = 'ID';
  public $timestamps = false;
  protected $fillable =  [
      'ID_documento',
      'ID_pregunta',
      'respuesta'
  ];
}
