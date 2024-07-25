<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $table = 'lessons';
    protected $fillable = [
        'path','name','description'];

        public function level(){
            return $this->hasOne('level::class');
        }

    use HasFactory;
}
