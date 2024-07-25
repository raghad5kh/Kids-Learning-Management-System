<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Student extends Authenticatable
{
    use HasApiTokens,Notifiable,SoftDeletes ;
    protected $table = 'students';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'email','password','owner'];
        protected $hidden = [
            'password',
            'remember_token',
        ];

        public function quiz_result(){
            return $this ->hasMany('Quiz_result::class');
        }
        public function archeivement(){
            return $this ->hasMany(Archeivement::class);
        }

        public function compliant(){
            return $this->hasMany('compliants::class');
        }
        public function record(){
            return $this->belongsTo(Record::class);
        }

    use HasFactory;
}
