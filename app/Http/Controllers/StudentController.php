<?php

namespace App\Http\Controllers;
 use App\Models\Student;
 use App\Models\Archeivement;
 use App\Models\Level;
 use App\Models\Compliant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LaravelJsonApi\Eloquent\Filters\OnlyTrashed;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{  use GenTraits;
    public function getLevel(){

          //  $student = Student::find($id);
          $student = Auth::user();
            if (!$student) {
                return $this->error('Student not found', 'error', 404);
            }

         $record= $student->record->main_level;
         $level= Level::all()->where('main_level_id',$record->id);
         $i=1;
         foreach( $level as $le){
         $Archeivement =Archeivement::all()->where('student_id', $student->id)->where('level_id', $le->id)->first();
         $students = DB::table('archeivements')
         ->join('students', 'archeivements.student_id', '=','students.id')
         ->select('students.nickname','students.name','students.photo')
         ->where('archeivements.level_id', '=', $le->id)
         ->where('archeivements.total_scores','!=',NULL)
         ->get();

         $result[]= [
         'level_number'=>$i,
         'level_id'=>$le->id,
         'isavailable'=> $Archeivement->isavailable,
         'isquiz'=> $le->is_quiz,
         'name'=> $students

            ];
            $i=$i+1;
        }
            return $this->success( $result , '200','');

        }

      public function show($id){
        $level = Level::find($id);
        if($level->is_quiz=='true'){
         $quiz = DB::table('quizs')->where('level_id', '=', $level->id)->first();
         $questions = DB::table('questions')->where('quiz_id', $quiz->id)->get();
         foreach($questions as $ques){
          $options = DB::table('answers')->where('question_id', $ques->id)->select('id','option')->get();
          $resultop=[];
          $i=1;
          foreach($options as $opt){

              $resultop[]=[
              'id'=>$i,
             'option'=>$opt->option
              ];
              $i=$i+1;
          }
          $i=1;
          $result[]= [
              'id'=>$ques->id,
              'questions'=>$ques->question,
             'correctAnswerIndex'=>$ques->correct_answer,
             'answers'=> $resultop
              ];
          }
          $result_f[]=[
            'quiz_id'=> $quiz->id,
            $result
          ];
          return response( $result_f,200);
        }
        $lesson = DB::table('lessons')->where('level_id', '=', $level->id)->first();
        $lesson_t=[
            $lesson
        ];
        $name_file=  basename($lesson->path);
        $name_file1 = 'http://127.0.0.1:8000/storage/files/'.$name_file;
      //  $contents = Storage::get('files\t83PLQedjgWVXoUa5LQ4PdKo5SX3niu8kDnIlZG6.pdf');

       // $path = Storage::url('files/t83PLQedjgWVXoUa5LQ4PdKo5SX3niu8kDnIlZG6.pdf');
        $lesson_t=[[
            'id'=>$lesson->id,
            'description'=> $lesson->description,
            'name'=> $lesson->name,
            'file_name'=> $lesson->name_file,
            'path'=> $name_file1 ,

        ]];
        return response()->json([
            'data'=> $lesson_t,
             ]);

       // return $this->success($lesson_t , '200','Student found');
      }
//....................................................................................................
         public function store(Request $request)
           {

             $code = $request->password;
             $record = DB::table('records')->where('id_number', $code)->first();
              if ($record !== null) {
               $email = $request->input('email');
               $count = DB::table('students')->where('email', '=', $email)->count();
               $count1 = DB::table('students')->where('record_id', '=', $record->id)->count();
               if($count == 0){
                if ($count1 == 0) {
              $request->validate([
                        'email'=>'required|email',
                        'password' => 'required',
                        'owner' => 'required'
                    ]);


              $student = new Student;
              $student->record_id = $record->id;
              $student->email = $request->email;
              $student->name = $record->first_name;
              $student->password = bcrypt($request->password);
              $student->owner = $request->owner;
              $student->save();
              $mainLevel = $record->main_level_id;
              $level = DB::table('levels')->where('main_level_id', $mainLevel)->get();
              foreach( $level as $le){
              $arch = new Archeivement;
              if($le->id==1 || $le->id==13 || $le->id==25 ){
                  $arch->level_id=$le->id;
                  $arch->student_id=$student->id;
                  $arch->isavailable='true';
                  $arch->save();
                 }
                 else{
                   $arch->level_id=$le->id;
                   $arch->student_id=$student->id;
                   $arch->isavailable='false';
                   $arch->save();}
                 }
                 $token = $student->createToken('API TOKEN')->plainTextToken;
                  return response()->json([
                   'message'=> "logged in",
                   'token'=> $token,
                   'main_level'=> $record->main_level_id,
                   'data'=>$student
                    ]);
                }

                return $this->error('', 'the code is invalid', 404);
            }
                else {
                    $student = DB::table('students')->where('email', '=', $email)->first();
                    if( $student->deleted_at!=NULL){
                    return $this->error('', 'Student not found in app', 404);
                 }

                }

                $user = Student::where('email',$request->email)->first();
                $token= $user->createToken('APT TOKEN')->plainTextToken;
                return response()->json([
                    'message'=> "logged in ",
                    'main_level'=> $record->main_level_id,
                    'token'=> $token,
                    'data'=>$user
                ]);



        }
        else {
            return $this->error('', 'code not found', 404);
        }
            }
    //..................................................................................................
    public function update(Request $request)
    {
        $student = Auth::user();
        $student = Student::find($student->id);
        if (!$student) {
         return $this->error( $student,'Student not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'photo' => 'required',
            'nickname' => 'required',

        ]);

        if($request->photo)
        {
            $student->photo = $request->photo;
        }
        if($request->nickname)
        {
            $student->nickname = $request->nickname;
        }

        $student->save();
        return $this ->success('',200,' student updated successfully');
    }
    public function profile(){
        $student = Auth::user();
        $result=[
       'nikname'=>  $student->nickname,
       'photo'=>  $student->photo,
        ];

        return $this ->success($result,200,'');
    }

    public function endLevel($id){
     $student = Auth::user();
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
    //    $topThreeResults = DB::table('archeivements')
    //                 ->orderBy('total_scores', 'desc')
    //                 ->limit(3)
    //                 ->get();


       return $this ->success($result,200,'Congratulations, this level has been successfully passed.');
     }
     return $this->error( $result,'Opps try again', 404);
    }

    public function top_3($id){
        $topThreeResults_1 = DB::table('archeivements')
        ->join('students', 'archeivements.student_id', '=','students.id')
        ->select('students.nickname','students.name','students.photo')
        ->where('archeivements.level_id', '=', $id)
        ->where('archeivements.total_scores','>=',95)
        ->get();
        $topThreeResults_2 = DB::table('archeivements')
        ->join('students', 'archeivements.student_id', '=','students.id')
        ->select('students.nickname','students.name','students.photo')
        ->where('archeivements.level_id', '=', $id)
        ->whereBetween('archeivements.total_scores',[80,91])
        ->get();
        $topThreeResults_3 = DB::table('archeivements')
        ->join('students', 'archeivements.student_id', '=','students.id')
        ->select('students.nickname','students.name','students.photo')
        ->where('archeivements.level_id', '=', $id)
        ->whereBetween('archeivements.total_scores',[60,75])
        ->get();

        $result_top[]=[
          'top three_>=95'=> $topThreeResults_1,
          'top three_>=80'=> $topThreeResults_2,
          'top three_>=60'=> $topThreeResults_3

        ];
        return $this ->success($result_top,200,'');

    }

    public function top_3_All(){

        $top_student = DB::table('archeivements')
        ->select(DB::raw('SUM(total_scores) as total_scores'))
        ->groupBy('student_id')
        ->orderByDesc('total_scores')
        ->get()->toArray();
     //   $result = [];
       foreach ($top_student as $item) {
        $test=$item->total_scores;
       $result[] = $test;
      }
      $uniqueArray = array_unique($result);
      rsort($uniqueArray);
      $top_1 = DB::table('archeivements')
      ->join('students', 'archeivements.student_id', '=','students.id')
      ->select('students.nickname','students.name','students.photo', DB::raw('SUM(total_scores) as total_scores'))
      ->groupBy('students.nickname','students.name','students.photo')
      ->havingRaw('total_scores = ?', [$uniqueArray[0]])
      ->get();

      $top_2 = DB::table('archeivements')
      ->join('students', 'archeivements.student_id', '=','students.id')
            ->select('students.nickname','students.name','students.photo', DB::raw('SUM(total_scores) as total_scores'))
            ->groupBy('students.nickname','students.name','students.photo')
            ->havingRaw('total_scores = ?', [$uniqueArray[1]])
            ->get();
      $top_3 = DB::table('archeivements')
      ->join('students', 'archeivements.student_id', '=','students.id')
            ->select('students.nickname','students.name','students.photo', DB::raw('SUM(total_scores) as total_scores'))
            ->groupBy('students.nickname','students.name','students.photo')
            ->havingRaw('total_scores = ?', [$uniqueArray[2]])
            ->get();
            $result_top[]=[
                'top 1'=> $top_1,
                'top 2'=> $top_2,
                'top 3'=> $top_3

              ];
        return $this ->success( $result_top,200,'');


    }

    }
