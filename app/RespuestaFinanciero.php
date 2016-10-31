<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaFinanciero extends Model
{
  protected $table = 'tbl_respuesta_paso4_financiero';
  protected $primaryKey = 'ID';
  public $timestamps = false;
  protected $fillable =  [
      'ID_documento',
      'producto_financiero',
      'tiene_beneficiario',
      'porcentaje',
      'cambiar_beneficiario',
      'beneficiario'
  ];
}
