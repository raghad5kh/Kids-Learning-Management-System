<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premission extends Model
{
    protected $table = 'premissions';
    protected $fillable = [
        'title'];
        protected $hidden = ['pivot'];
        public function premissions(){
            return $this->hasMany(Premission_role::class,'premission_id');
        }
    use HasFactory;
}
