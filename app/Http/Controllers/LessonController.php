<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use response;
use DB;
use storage;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller {
  use GenTraits;
  public function index (){
    $lesson =Lesson::all() ;
    if(empty( $lesson)){
        return response()->json( 'not found', 404);
    }
    foreach( $lesson as $le){
        $admin =User::find($le->admin_id);
        $name_file= basename($le->path);
        $name_file1 = 'http://127.0.0.1:8000/storage/files/'.$name_file;
        $result[]= [
        'id'=>$le->id,
        'description'=> $le->description,
        'name'=> $le->name,
        'file_name'=> $le->name_file,
        'path'=> $name_file1,
        'teacher_name'=> $admin->name,

             ];
    }
    return response()->json( $result, 200);
  }
	public function add_lesson(Request $request)
	{
        $admin=auth()->user();
		$validator = Validator::make($request->all(),[
      'file' => 'required|mimes:pdf',
      'description' => 'required',
      'name'=>'required',
     // 'path'=>'required',
      'level_id'=>'required',
  ]);

   if($validator->fails()) {
  return $this->error('','lesson not found', 404);
   }

  $name_file = $request->file->getClientOriginalName();
   if ($file = $request->file('file')) {
    $path = $file->store('public/files');
    $name = $request->name;
   // $name = $file->getClientOriginalName('name');
    $save = new Lesson();
    $save->name = $request->name;
    $save->description = $request->description;
    $save->path= $path;
    $save->name_file=  $name_file;
    $save->level_id= $request->level_id;
    $save->admin_id= $admin->id;
    $save->save();

    return $this->success( '' ,200,'lesson add successfully');
        }}
 //............................................................................................
        public function delete( $id) {
            $file =Lesson::find($id);
            if(empty($file)) {
                return $this->error('','Invalid ID',404);
           }
            $admin = Auth::user();
            if($file->admin_id!=$admin->id){
                if($admin->id!=1){
                return $this->error('','you are not allowed to delete this lesson',403);
            }}
             $path1 = $file->path;
             $name_file=  basename($path1);
             $name_file1 = '\storage\files\\'.$name_file;
             $path = public_path($name_file1);
             unlink ($path);
             $file->delete();
             return $this->success( '',200,'lesson successfully delete');


        }
//..............................................................................................


public function update(Request $request, $id)
{
    $lesson = Lesson::find($id);
    if(empty($lesson)) {
        return $this->error('','Invalid ID',404);
   }
    $admin = Auth::user();

    if($lesson->admin_id!=$admin->id){
        if($admin->id!=1){
        return $this->error('','you are not allowed to edit this lesson',403);
    }}

    $validator = Validator::make($request->all(), [

        'description' => 'required',
        'name' => 'required',
        'file' => 'required|mimes:pdf',

    ]);

    if($request->description)
    {
        $lesson->description = $request->description;
    }
    if($request->name)
    {
        $lesson->name = $request->name;
    }
    if($request->file)
    {
        $path1 = $lesson->path;
        $name_file=  basename($path1);
        $name_file1 = '\storage\files\\'.$name_file;
        $path = public_path($name_file1);
        unlink ($path);
        $name_file = $request->file->getClientOriginalName();
        $lesson->name_file= $name_file;
        if ($file = $request->file('file')) {
            $path = $file->store('public/files');
            $lesson->path= $path;
        }
    }


    $lesson->save();
    return $this ->success( '' ,200,'lesson updated successfully');

}
}







