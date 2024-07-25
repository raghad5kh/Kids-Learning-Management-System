<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_level extends Model
{
    protected $table = 'main_levels';
    public $timestamps = false;
    protected $fillable = [
        'name_level'];

        public function level(){
            return $this ->hasMany('Level::class');
        }
        public function record(){
            return $this ->hasMany(Record::class);
        }
    use HasFactory;
}
