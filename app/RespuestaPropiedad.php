<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaPropiedad extends Model
{
  protected $table = 'tbl_respuesta_paso4_propiedad';
  protected $primaryKey = 'ID';
  public $timestamps = false;
  protected $fillable =  [
      'ID_documento',
      'pais',
      'domicilio',
      'nro_finca',
      'nro_folio',
      'nro_libro'
  ];
}
