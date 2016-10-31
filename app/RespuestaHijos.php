<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaHijos extends Model
{
  protected $table = 'tbl_respuesta_paso3_hijos';
  protected $primaryKey = 'ID';
  public $timestamps = false;
  protected $fillable =  [
      'ID_documento',
      'nombre',
      'genero',
      'fecha_nacimiento',
      'lugar',
      'departamento',
      'inscripcion_renap',
      'nose_renap'
  ];
}
