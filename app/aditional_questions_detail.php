<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aditional_questions_detail extends Model
{
  protected $table = 'aditional_questions_detail';

  protected $fillable = ['id_aditional', 'label', 'value'];

  public function aditional_questions(){
    return $this->belongsTo('\App\aditional_questions');
  }

}
