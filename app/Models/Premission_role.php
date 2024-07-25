<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premission_role extends Model
{
    protected $table = 'premissions_roles';
    protected $fillable = [
        'premission_id','role_id'];
        public function role(){
            return $this->belongsTo(Role::class);

    }
    public function premission(){
        return $this->belongsTo(Premission::class);

}

    use HasFactory;
}
