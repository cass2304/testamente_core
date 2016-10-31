<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaDetalle extends Model
{
  protected $table = 'tbl_respuesta_detalle';
  protected $primaryKey = 'ID';
  public $timestamps = false;
  protected $fillable =  [
      'ID_detalle',
      'ID_respuesta',
      'respuesta',
      'label'
  ];
}
