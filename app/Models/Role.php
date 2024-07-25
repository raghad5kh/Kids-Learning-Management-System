<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'title','display'];
        // public function admin(){
        //     return $this ->hasMany('admin::class');
        // }
        // public function premission_role(){
        //     return $this ->hasMany('Premission_role::class');
        // }
        public function premissions(){
            return $this->belongsToMany(Premission::class,'role_id')
            ->select('title');
        }
        public function role(){
            return $this->hasMany(Premission_role::class,'role_id');
        }
        public function check($param){
            $permission = Premission::query()->where('title','=',$param)->first();
            return Premission_role::query()
            ->where('premission_id','=',$permission->id)
            ->where('role_id','=',$this->id)
            ->exists();
        }
    use HasFactory;
}
