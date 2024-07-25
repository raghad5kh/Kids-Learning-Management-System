<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompliantController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\MainLevelController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ArcheivementController;
use App\Models\Archeivement;

Route::middleware('auth:sanctum','access.control')->group( function () {

 ///main level
  Route::get('main_level', [MainLevelController::class, 'index'])->name('main_level');
 //level
   Route::get('levels/{id}', [LevelController::class, 'index'])->name('levels');

 // manager record
  Route::get('get_all_students', [RecordController::class, 'index'])->name('get_all_students');
  Route::post('add_new_student', [RecordController::class, 'store'])->name('add_new_student');
  Route::put('update_info_student_by_id/{student}', [RecordController::class, 'update_student'])->name('update_info_student');
  Route::delete('delete_student_by_id/{student}', [RecordController::class, 'soft_delete'])->name('delete_student');
  Route::get('back_from_soft_delete_student/{student}', [RecordController::class, 'back_from_soft_delete'])->name('back_from_soft_delete_student');
  Route::get('trashed_Student', [RecordController::class, 'trashed_Student'])->name('trashed_Student');
  Route::get('search_name_student/{student}', [RecordController::class, 'search_name'])->name('search_name_student');
 //.....................................................................................................................
 //manager  Teacher
 Route::get('get_all_Teacher', [AdminController::class, 'index'])->name('get_all_Teacher');
 Route::post('add_teacher', [AdminController::class, 'store'])->name('add_teacher');
// Route::get('teacher_by_id/{teacher}', [AdminController::class, 'show'])->name('teacher_by_id');
 Route::put('update_teacher_by_id/{teacher}', [AdminController::class, 'update'])->name('update_teacher');
 Route::delete('delete_teacher_by_id/{teacher}', [AdminController::class, 'soft_delete'])->name('delete_teacher');
 Route::get('back_from_soft_delete/{teacher}', [AdminController::class, 'back_from_soft_delete'])->name('back_from_soft_delete_te');
 Route::get('search_name_teacher/{teacher}', [AdminController::class, 'search_name'])->name('search_name_teacher');
//..........................................................................................
 // manager compliants
 Route::get('get_all_compliants', [CompliantController::class, 'index'])->name('get_all_compliants');

//Route::get('compliant_by_id/{compliant}', [CompliantController::class, 'show']);
 Route::delete('solution_compliant_by_id/{lesson}', [ CompliantController::class, 'solution'])->name('solution_compliant');
 Route::get('get_solved_list', [ CompliantController::class, 'indexsu'])->name('get_solved_list');

  //manager lesson
 Route::get('get_all_T', [LessonController::class, 'index'])->name('get_all_T');
 Route::post('add_lesson', [LessonController::class, 'add_lesson'])->name('add_lesson');
 Route::post('update_Lesson_by_id/{id}', [LessonController::class, 'update'])->name('update_Lesson');
 Route::delete('delete_lesson_by_id/{lesson}', [LessonController::class, 'delete'])->name('delete_lesson');

 //manager Quiz
 Route::get('get_all_quizs', [QuizController::class, 'index'])->name('get_all_quizs');
 Route::post('add_quiz', [QuizController::class, 'store'])->name('add_quiz');
 Route::put('put_question_by_id/{quiz}', [QuizController::class, 'update'])->name('update_question');

 ///profile
 Route::get('show_profile', [AdminController::class, 'profile'])->name('show_profile');

 // ////archeivement
 Route::get('game_result', [ArcheivementController::class, 'game_result'])->name('game_result');
 Route::get('quiz_result', [ArcheivementController::class, 'quiz_result'])->name('quiz_result');
});

Route::middleware('auth:sanctum')->group( function () {

    Route::get('main_level_student', [StudentController::class, 'getLevel']);
    Route::put('update_student', [StudentController::class, 'update']);
    Route::post('add_compliants', [CompliantController::class, 'store']);
    Route::post('score_quiz', [QuizController::class, 'score']);
    Route::get('profile', [StudentController::class, 'profile']);

    Route::post('score_game/{id}', [GameController::class, 'score_game']);
    Route::get('endLevel/{id}', [StudentController::class, 'endLevel']);

    ////archeivement
    Route::get('archeivement', [ArcheivementController::class, 'index']);


});

  Route::get('show_info_level/{id}', [StudentController::class, 'show']);

  ////game
  Route::get('list_game/{id}', [GameController::class, 'getGames']);
  Route::get('get_game/{id}/{id1}/{id2}', [GameController::class, 'index']);

////top 3
  Route::get('top_3/{id}', [StudentController::class, 'top_3']);

  ///top 3 all
  Route::get('top_3_all', [StudentController::class, 'top_3_All']);

   //login admin and teacher
  Route::post('login', [AdminController::class, 'login']);
  Route::post('add_info_student', [StudentController::class, 'store']);
//.........................................................................................

//manager  student

//Route::put('update_student_by_admin/{student}', [StudentController::class, 'update_admin']);


//.................................................................................................









//.......................................................................................................................



//.......................................................................................................................



//...........................................................................................................


// Route::put('update_Quiz_by_id/{quiz}', [QuizController::class, 'update']);
//...........................................................................................................
//  //manager Question
//  Route::get('get_all_questions', [QuestionController::class, 'index']);
//  Route::post('add_question', [QuestionController::class, 'store']);
//  Route::put('update_Question_by_id/{question}', [QuestionController::class, 'update']);
//  Route::put('update_Question_answer_by_id/{question}', [QuestionController::class, 'update_answer']);

//  Route::get('question_by_id/{question_id}', [QuestionController::class, 'show']);
//  Route::delete('delete_question_by_id/{question}', [QuestionController::class, 'destroy']);
//  //..........................................................................................................

//  //manager for answer
//  Route::get('get_all_Answers', [AnswerController::class, 'index']);
//  Route::post('add_answer', [AnswerController::class, 'store']);
//  Route::put('update_Answer_by_id/{answer}', [AnswerController::class, 'update']);
//  Route::delete('delete_answer_by_id/{answer}', [AnswerController::class, 'destroy']);
//  Route::get('Answer_by_id/{answer_id}', [AnswerController::class, 'show']);
//  //.............................................................................................................

//  //manager for quiz_reuslt
//  Route::get('get_all_Quiz_result', [Quiz_reusltController::class, 'index']);
//  Route::post('add_result', [Quiz_reusltController::class, 'store']);
//  Route::put('update_Result_by_id/{result}', [Quiz_reusltController::class, 'update']);
//  Route::delete('delete_Result_by_id/{result}', [Quiz_reusltController::class, 'destroy']);
//  Route::get('result_by_id/{result_id}', [Quiz_reusltController::class, 'show']);
//  Route::post('check', [Quiz_reusltController::class, 'checkPoint']);
 //............................................................................................................

