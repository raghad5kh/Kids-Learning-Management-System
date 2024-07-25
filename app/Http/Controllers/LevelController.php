<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Traits\GenTraits;
class LevelController extends Controller
{
    use GenTraits;
    public function index ($id){
    $level= Level::all()->where('main_level_id',$id);
    return $this->success($level,200,'');

      }
}
