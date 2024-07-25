<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Question;
use App\Models\Quiz_result;
use Illuminate\Support\Facades\Validator;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\Auth;
use App\Models\Archeivement;
use Illuminate\Support\Facades\DB;
class QuizController extends Controller
{
    use GenTraits;
    public function index (){
        $quiz=Quiz::all();
       foreach($quiz as $quizs){
        $admin =User::find($quizs->admin_id);
        $result=[];
       $questions = DB::table('questions')->where('quiz_id', $quizs->id)->get();
       foreach($questions as $ques){
        $options = DB::table('answers')->where('question_id', $ques->id)->get();
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
           'answers'=> $resultop,
           'correctAnswer'=>$ques->correct_answer,
            ];
        }
        $resultf[]= [
            'quiz_id' =>$quizs->id,
            'description'=>$quizs->description,
            'teacher_name'=>$admin->name,
             $result
        ];
        }
        return response( $resultf,200);
    }
//........................................................................................

public function store(Request $request)
{
    $admin=auth()->user();
    $request->validate([
        'level_id'=> 'required',
        'description' => 'required',
        //'question' =>  ['required','array'],
        'question.*.question'=>'required',
        'question.*.option.*.option'=>'required',
        'question.*.correct_answer'=>'required',
        //'correct_answer' =>  ['required','array'],
        //'option' =>  ['required','array'],
        // 'option2' =>  ['required','array'],
        // 'option3' =>  ['required','array'],
        // 'option4' =>  ['required','array'],



    ]);

    $input = $request->all();
    $quiz = new Quiz;
    $quiz->description = $request->description;
    $quiz->admin_id =$admin->id;
    $quiz->level_id=$request->level_id;
    $quiz->save();

     $input['question'] = array($input['question']);
//    $input['option.*.option'] =  array_unique($input['option.*.option']);
    // $input['option2'] = array_unique($input['option2']);
    // $input['option3'] = array_unique($input['option3']);
    // $input['option4'] = array_unique($input['option4']);
   // $input['correct_answer'] = array_unique($input['correct_answer']);
    foreach($input['question'] as $ques){
        foreach($ques as $que){
    $question= new Question();
   // $firstElementan = array_shift($input['correct_answer']);
    $question->quiz_id = $quiz->id;
    $test=array_shift($que);
   $question->question= $test;
   $test3=array_shift($que);
   $test1=array_shift($que);
     $question->correct_answer= $test1;
     $question->save();

    foreach($test3 as $op){
        $answer1= new Answer();
        $test4=array_shift($test3);
        //$test5=array_shift($test4);
        $answer1->question_id =$question->id;
        //$arr = json_decode($op);
        $answer1->option= $test4['option'];
          $answer1->save();
        // $answer2= new Answer();
        // $answer2->question_id =$question->id;
        // $answer2->option= $op;
        // $answer2->save();
        // $answer3= new Answer();
        // $answer3->question_id =$question->id;
        // $answer3->option= $op;
        // $answer3->save();
        // $answer4= new Answer();
        // $answer4->question_id =$question->id;
        // $answer4->option= $op;
        // $answer4->save();
      //  return $this->success($op, 200,'quiz add successfuly');
    }
    }}
//     $firstElement1 = array_shift($input['option']);
//     $firstElement2 = array_shift($input['option']);
//     $firstElement3 = array_shift($input['option']);
//     $firstElement4 = array_shift($input['option']);

//    // $op= $input['option'][0];
//     //unset($input['option'][0]);
//     //array_shift($input);
//     //foreach($input['option'] as $op){
//         $answer1= new Answer();
//         $answer1->question_id =$question->id;
//         $answer1->option= $firstElement1;
//         $answer1->save();
//         $answer2= new Answer();
//         $answer2->question_id =$question->id;
//         $answer2->option= $firstElement2;
//         $answer2->save();
//         $answer3= new Answer();
//         $answer3->question_id =$question->id;
//         $answer3->option= $firstElement3;
//         $answer3->save();
//         $answer4= new Answer();
//         $answer4->question_id =$question->id;
//         $answer4->option= $firstElement4;
//         $answer4->save();
        // $correct_answer= new Answer();
        // $correct_answer->question_id =$question->id;
        // $correct_answer->correct_answer= $firstElementan;
        // $correct_answer->save();
        // // $answer->option= $firstElement2;
        // $answer->option= $firstElement3;
        // $answer->option= $firstElement4;
        // $answer->correct_answer= $firstElementan;
        // $answer->save();
      //  unset($input['option'][1]);
        // array_shift($input);
        //}

//}

    return $this->success( '', 200,'quiz add successfuly');
}
//......................................................................................
public function score(Request $request){
    $student=auth()->user();
    $request->validate([
        'score' => 'required',
        'quiz_id' => 'required',

    ]);
    $quiz = Quiz::find($request->quiz_id);
    $id=$quiz->level_id;
    $count = DB::table('quizs_results')->where('quiz_id', '=', $request->quiz_id)->where('student_id','=',$student->id)->count();
    if($count==0){
        $result=  new Quiz_result;}
      else{
      $qu = DB::table('quizs_results')->where('quiz_id', '=', $request->quiz_id)->where('student_id','=',$student->id)->first();
      $result= Quiz_result::find($qu->id);
          }

    $result->student_id= $student->id;
    $result->quiz_id= $request->quiz_id;
    $result->score= $request->score;
    $result->save();


    if($result->score>50){
        $arch = DB::table('archeivements')->where('level_id', '=', $id)->where('student_id', '=', $student->id)->first();
         $arch_f = Archeivement::find($arch->id);
        $arch_f->total_scores=$request->score;
         $arch_f->save();
         $arch_next = DB::table('archeivements')->where('level_id', '=', $id+1)->where('student_id', '=', $student->id)->first();
         $arch_nf=Archeivement::find($arch_next->id);
         $arch_nf->isavailable='true';
         $arch_nf->save();
       }
    return $this->success('', 200,'score add successfuly');
}
// public function destroy($id)
// {
//     $question = Question::find($id);
//     $quiz_idd=$question->quiz_id;
//     $quii = Quiz::find($quiz_idd);
//     $admin=auth()->user();
//     if($quii->admin_id!=$admin->id){
//         if($admin->id!=1){
//         return $this->error('','you are not allowed to delete this question',403);
//     }}
//     if ($question) {
//         $answers = DB::table('answers')->where('question_id', $question->id)->get();
//         $question->delete();
//         //$answers->delete();
//         return $this->success( $question , 200,'question delete');

//     } else {
//         return $this->error('','cannot delete anysthing',500);
//     }
// }
//.....................................................................................
public function update(Request $request, $id)
{
    $question = Question::find($id);
    if (!$question) {
        return $this->error('','cannot show anysthing',500);
    }
    $validator = Validator::make($request->all(), [

        'question' => 'required',
        'correct_answer' => 'required',
        'option' =>  ['required','array'],


    ]);
    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 400);
    }
    $input = $request->all();
    $question->question=$request->question;
    $question->correct_answer=$request->correct_answer;

    $question->save();
    $options = DB::table('answers')->where('question_id', $question->id)->get();

   // $users = Question::with('answer')->get();
    $tt= $input['option'] = array($input['option']);
   $test=array_shift($tt);

    foreach($options as $opti){
        $optio = Answer::find( $opti->id);
        $test1=array_shift($test);
       $optio->option= $test1['option'];
        $optio->save();
    //    return $this ->success($opti->option,200,'question updated successfully');
    }
   // $options->option='99';
   // $options->save();
    return $this ->success('',200,'question updated successfully');

}

}
