<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archeivement extends Model
{

    protected $table = 'archeivements';
    protected $fillable = [
      'student_id', 'level_id',
      'total_scores','isavailable'];
      public function level(){
        return $this->belongsTo(Level::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);}
    use HasFactory;
}
