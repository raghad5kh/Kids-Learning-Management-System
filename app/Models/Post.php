<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
 /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = 'Post';
    protected $fillable = [
        'name',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

        'remember_token',
    ];


}

