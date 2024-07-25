<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{ protected $table = 'games_list';
    protected $fillable = [
        'photo','name'];

        public function level(){
            return $this ->hasMany(Level::class);
        }
    use HasFactory;
}
