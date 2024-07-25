<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Record extends Model
{use SoftDeletes;
    protected $table = 'records';
   protected $date = ['birthdate'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at','deleted_at'];
    protected $fillable = [
        'birthdate','first_name','last_name','main_level_id','phone','address','gender'];
        public function main_level(){
            return $this->belongsTo(Main_level::class);
        }
        public function student(){
            return $this->hasOne(Student::class);
        }


    use HasFactory;
}
