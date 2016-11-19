<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaActivos extends Model
{
  protected $table = 'tbl_respuesta_paso5_activos';
  protected $primaryKey = 'ID';
  public $timestamps = false;
  protected $fillable =  [
      'ID_documento',
      'activo',
      'monto',
      'beneficiario',
      'porcentaje'
  ];
}
