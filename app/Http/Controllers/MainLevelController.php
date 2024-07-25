<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main_level;
class MainLevelController extends Controller
{
    public function index (){
    
      return response()->json(Main_level::all(), 200);
    }
}
