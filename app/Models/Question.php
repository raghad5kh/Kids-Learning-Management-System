<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'question','quiz_id','answer_question','point_question','correct_answer'];
        public function quiz(){
            return $this->belongsTo(Quiz::class);

    }
    public function answer(){
        return $this ->hasMany(Anwser::class);
    }
    use HasFactory;
}
