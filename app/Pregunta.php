<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
  protected $table = 'tbl_preguntas';
  protected $primaryKey = 'ID';
  public $timestamps = false;
  protected $fillable =  [
      'paso',
      'nro_pregunta',
      'sub_pregunta',
      'pregunta'
  ];
}
