<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class family_information extends Model
{
  protected $table = 'family_information';

  protected $fillable = ['mate_name', 'imu_data', 'regimen','child_name','child_birthdate','child_nationality','child_placebirth','renap_data','user_id' ];

  public function User(){
    return $this->belongsTo('\App\User');
}
