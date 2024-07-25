<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_result extends Model
{
    protected $table = 'quizs_results';
    protected $fillable = [
     'level_id' , 'result','quiz_id','student_id'];


     public function level_id(){
        return $this->belongsTo('Main_level::class');}
        public function student(){
            return $this->belongsTo('Student::class');
    }
    public function quiz(){
        return $this->belongsTo('Quiz::class');

}

    use HasFactory;
}
