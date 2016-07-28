<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
   // protected $hidden = ['password', 'remember_token'];
    protected $hidden = ['remember_token'];

    public function personal_information(){
    	return $this->hasOne('\App\personal_information');
   	}

    public function family_information(){
    	return $this->hasMany('\App\family_information');
   	}

    public function beneficiary(){
    	return $this->hasMany('\App\beneficiary');
   	}

    public function property(){
    	return $this->hasMany('\App\property');
   	}

    public function location(){
    	return $this->hasOne('\App\location');
   	}
}
