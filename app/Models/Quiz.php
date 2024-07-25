<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizs';
    protected $fillable = ['description'];
        public function quiz_result(){
            return $this ->hasMany('Quiz_result::class');
        }
        public function question(){
            return $this ->hasMany('Question::class');
        }
    use HasFactory;
}
