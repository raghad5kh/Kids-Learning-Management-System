<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class  User extends  Authenticatable
{
    use SoftDeletes,HasApiTokens,Notifiable ;
    protected $table = 'users';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'phone','name','email','password','role_id','level'];
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
        protected $hidden = [
            'password',
            'remember_token',
        ];
        public function role(){
            return $this->belongsTo('Role::class');

    }
    public function compliant(){
        return $this->hasMany('compliants::class');
    }

    use HasFactory;
}
