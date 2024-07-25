<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Game1;
use App\Models\Game2;
use App\Models\Game3;
use App\Models\Game4;
use App\Models\Game_result;
use Illuminate\Http\Request;
use App\Models\Archeivement;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class GameController extends Controller
{
    use GenTraits;
    public function getGames($id){
        $game= Game::all()->where('level_id','=',$id);
        return $this->success($game,200,'');

    }
    public function index($id,$id1,$id2){

        if($id1==1){
            if($id2==1 || $id2==2){
            $game = DB::table('games1')->where('level_id', '=', $id)->select('word','image')->get();}
      else{
            $game = DB::table('games1')->where('level_id', '=', $id)->select('word','text')->get();}

        }
        if($id1==2){
            $game = DB::table('games2')->where('level_id', '=', $id)->get();
        }
        if($id1==3){
         $game_1 = DB::table('games3')
          ->whereBetween('id', [1, 8])
          ->get();
         $game_2 = DB::table('games3')
          ->whereBetween('id', [9, 16])
          ->get();
          $game=[
            'index1'=> $game_1 ,
            'index2'=> $game_2
          ];


        }
        if($id1==4){
            $game = DB::table('games4')->where('level_id', '=', $id)->get();
        }

        return $this->success($game,200,'');

    }
    public function score_game(Request $request,$id){
      $student=auth()->user();

      if($request->score_game1)
      {
       // $level = DB::table('games_list')->where('games1_id', '=', $id)->first();
        $count = DB::table('game_result')->where('level_id', '=', $id)->where('student_id','=',$student->id)->count();
        if($count==0){
        $game_result= new Game_result();}
        else{
          $ga = DB::table('game_result')->where('level_id', '=', $id->level_id)->first();
          $game_result= Game_result::find($ga->id);
        }
          $game_result->first_game  = $request->score_game1 ;
          $game_result->student_id=$student->id;
          $game_result->level_id=$id;
          $game_result->save();
      }
      if($request->score_game2)
      {
       // $level = DB::table('games_list')->where('games2_id', '=', $id)->first();
        $count = DB::table('game_result')->where('level_id', '=', $id)->where('student_id','=',$student->id)->count();
        if($count==0){
        $game_result= new Game_result();}
        else{
          $ga = DB::table('game_result')->where('level_id', '=', $id)->where('student_id','=',$student->id)->first();
          $game_result= Game_result::find($ga->id);
        }
          $game_result->second_game = $request->score_game2 ;
          $game_result->student_id=$student->id;
          $game_result->level_id=$id;
          $game_result->save();
      }
      if($request->score_game3)
      {
       // $level = DB::table('games_list')->where('games3_id', '=', $id)->first();
        $count = DB::table('game_result')->where('level_id', '=', $id)->where('student_id','=',$student->id)->count();
        if($count==0){
        $game_result= new Game_result();}
        else{
          $ga = DB::table('game_result')->where('level_id', '=', $id)->where('student_id','=',$student->id)->first();
          $game_result= Game_result::find($ga->id);
        }
          $game_result->third_game = $request->score_game3 ;
          $game_result->student_id=$student->id;
          $game_result->level_id=$id;
          $game_result->save();
      }
      if($request->score_game4)
      {
       // $level = DB::table('games_list')->where('games4_id', '=', $id)->first();
        $count = DB::table('game_result')->where('level_id', '=', $id)->where('student_id','=',$student->id)->count();
        if($count==0){
        $game_result= new Game_result();}
        else{
          $ga = DB::table('game_result')->where('level_id', '=', $id)->where('student_id','=',$student->id)->first();
          $game_result= Game_result::find($ga->id);
        }
          $game_result->fourth_game = $request->score_game4 ;
          $game_result->student_id=$student->id;
          $game_result->level_id=$id;
          $game_result->save();
      }
      $arch = DB::table('archeivements')->where('level_id', '=', $id)->where('student_id', '=', $student->id)->first();
      $game_result = DB::table('game_result')->where('level_id', '=', $id)->where('student_id', '=', $student->id)->first();
      $result = $game_result->first_game+
                $game_result->second_game+
                $game_result->third_game+
                $game_result->fourth_game;
      if($result>70){
       $arch_f=Archeivement::find($arch->id);
       $arch_f->total_scores= $result;
        $arch_f->save();
        $arch_next = DB::table('archeivements')->where('level_id', '=', $id+1)->where('student_id', '=', $student->id)->first();
        $arch_nf=Archeivement::find($arch_next->id);
        $arch_nf->isavailable='true';
        $arch_nf->save();
      }
        return $this->success($game_result,200,'');

    }
}
