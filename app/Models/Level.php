<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
    public $timestamps = false;
    protected $fillable = [
     'lesson_id','main_level_id','game_id','is_quiz'];
     public function quiz_result(){
        return $this ->hasMany('Quiz_result::class');
    }
     public function main_level(){
        return $this->belongsTo('Main_level::class');
    }
    public function game(){
        return $this->belongsTo('Game::class');
    }
    public function archeivement(){
        return $this ->hasMany(Archeivement::class);
    }

    use HasFactory;
}
