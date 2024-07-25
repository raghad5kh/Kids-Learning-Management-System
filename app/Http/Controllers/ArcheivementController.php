<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\DB;
class ArcheivementController extends Controller
{
    use GenTraits;
   public function index(){
    $student=auth()->user();
    $count = DB::table('game_result')->where('student_id', $student->id)->count();
    $count1 = DB::table('quizs_results')->where('student_id', $student->id)->count();
    if($count==0 && $count1==0){
     return response()->json([
     'message'=> 'no result',
     ]);
     }
    if($count==0){
     $quiz_result = DB::table('quizs_results')->where('student_id', $student->id)->get();
     foreach( $quiz_result as $qu){
     $quiz =Quiz::find($qu->quiz_id);
     $result[]=[
      'level_id'=> $quiz->level_id ,
      'name_student'=>$student->name,
      'score'=>$qu->score,
      ];
     }
      $result_f=[
      'quize_result'=>$result
        ];
      return response( $result_f,200);

    }
    if($count1==0){
     $game_result = DB::table('game_result')->where('student_id', $student->id)->get();
     foreach( $game_result as $ga){
     $result[]=[
     'level_id'=>$ga->level_id,
     'name_student'=>$student->name,
     'first_game'=>$ga->first_game,
     'second_game'=>$ga->second_game,
     'third_game'=>$ga->third_game,
              //  'fourth_game'=>$ga->fourth_game,

            ];
            }
     $result_f=[
     'game_result'=>$result
     ];
     return response($result_f,200);


    }

      $game_result = DB::table('game_result')->where('student_id', $student->id)->get();

      $quiz_result = DB::table('quizs_results')->where('student_id', $student->id)->get();
     foreach( $game_result as $ga){
     $result_1[]=[
        //'id'=>$student->id,
        'level_id'=>$ga->level_id,
        'name_student'=>$student->name,
        'first_game'=>$ga->first_game,
        'second_game'=>$ga->second_game,
        'third_game'=>$ga->third_game,
      //  'fourth_game'=>$ga->fourth_game,

    ];
    }
     foreach( $quiz_result as $qu){
        $quiz =Quiz::find($qu->quiz_id);
        $result_2[]=[
            //'id'=>$student->id,
           // 'level_id'=>$qu->level_id,
           'level_id'=> $quiz->level_id ,
            'name_student'=>$student->name,
            'score'=>$qu->score,

        ];
    }
    $result_f=[
       'game_result'=>$result_1,
       'quize_result'=>$result_2
    ];

    return response($result_f,200);
   }
   public function game_result(){
    $count = DB::table('game_result')->count();
    if($count==0){
        return $this->success('', 200,'no result games');
    }
    $game_result = DB::table('game_result')->orderBy('student_id', 'asc')->get();

    foreach( $game_result as $ga){
     $student =Student::find($ga->student_id);
    $result[]=[
        //'id'=>$student->id,
        'level_id'=>$ga->level_id,
        'name_student'=>$student->name,
        'first_game'=>$ga->first_game,
        'second_game'=>$ga->second_game,
        'third_game'=>$ga->third_game,
      //  'fourth_game'=>$ga->fourth_game,

    ];
    }

    return response($result,200);
    }

     public function quiz_result(){
    $count = DB::table('quizs_results')->count();
    if($count==0){
        return $this->success('', 200,'no result quiz');
    }

    $quiz_result = DB::table('quizs_results')->orderBy('student_id', 'asc')->get();
    foreach( $quiz_result as $qu){
        $quiz =Quiz::find($qu->quiz_id);
        $student =Student::find($qu->student_id);
        $result[]=[
            //'id'=>$student->id,
           // 'level_id'=>$qu->level_id,
           'level_id'=> $quiz->level_id ,
            'name_student'=>$student->name,
            'score'=>$qu->score,

        ];
    }

    return response($result,200);
   }
}
