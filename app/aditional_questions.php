<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aditional_questions extends Model
{
    protected $table = 'aditional_questions';

    protected $fillable = ['id_documents', 'nro_questions', 'questions','answer','step','type' ];

    public function aditional_questions_detail(){
      return $this->hasOne('\App\aditional_questions_detail');
    }
    public function documents(){
      return $this->belongsToMany('\App\documents');
    }
}
