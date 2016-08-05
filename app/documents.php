<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class documents extends Model
{
  protected $table = 'documents';

  protected $fillable = ['user_id', 'step'];

  public function User(){
    return $this->belongsTo('\App\User');
  }

  public function aditional_questions(){
    return $this->belongsTo('\App\aditional_questions');
  }
}
