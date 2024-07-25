<?php

namespace App\Http\Controllers;
 use App\Models\Admin;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\GenTraits;
use LaravelJsonApi\Eloquent\Filters\OnlyTrashed;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{  use GenTraits;
    public function index (){
        $teacher = User::where('role_id','!=','1')->get();
        return response()->json($teacher, 200);

    }
    //...................................................................................
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'phone' => 'required|integer',
            'level' => 'required',

        ]);
        $admin = new User();
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->level = $request->level;
        $admin->password = bcrypt($request->password);
        $admin->save();
        $token = $admin->createToken('API TOKEN')->plainTextToken;
        return response()->json([
           'message'=> "add succcessfuly",
           'token'=> $token,
           'data'=>$admin
        ]);

    }
//...........................................................................................
    public function login(Request $request){
    if(!Auth::attempt($request->only('email','password'))){
        return response()->json([
            'message'=> "invalid email or password",
           ],401);

    }
    $user = User::where('email',$request->email)->first();
    $token= $user->createToken('APT TOKEN')->plainTextToken;
    return response()->json([
        'message'=> "logged in ",
        'token'=> $token,
        'data'=>$user
    ]);
    }

   public function show($admin)
   {

    try {
        $admin = User::find($admin);

        if( $admin){
         return $this->success($admin,200,'this is the admin');}

    } catch (Exception $ex) {
        return $this->error('','cannot show anysthing',500);
    }
   }
    //...................................................................................
    public function  update(Request $request, $id){
        $admin = User::find($id);
        if (!$admin) {
            return $this->error('','Invalid ID',404);
        }
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'level' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',


        ]);

        if($request->name)
        {
            $admin->name = $request->name;
        }
        if($request->level)
        {
            $admin->level = $request->level;
        }

        if($request->email)
        {
            $admin->email = $request->email;
        }
        if($request->password)
        {
            $admin->password = bcrypt($request->password);
        }
        if($request->phone)
        {
            $admin->phone = $request->phone;
        }


        $admin->save();
        return $this ->success($admin,200,'teacher updated successfully');

    }

    //.....................................................................................
    public function soft_delete($id)
    {
        $admin = User::find($id);
        if(empty($admin)) {
            return $this->error('','Invalid ID',404);
       }
       $lessons = DB::table("lessons")->where('admin_id', $admin->id)->get();
       foreach( $lessons as $less){
       $les = Lesson::find($less->id);
      // $les->admin_id = 4;


       $les->update([
      'admin_id'=> $les->admin_id = 1

       ]);}
       $quiz = DB::table("quizs")->where('admin_id', $admin->id)->get();
       foreach( $quiz as $qu){
       $qu = Quiz::find($qu->id);
      // $les->admin_id = 4;


       $qu->update([
      'admin_id'=> $qu->admin_id = 1

       ]);}

       $admin->delete($id);
        return   $this ->success($admin,200,'Teacher Delete successfully');




    }
    //........................................................................................
   public function back_from_soft_delete($id)
    {
    $admin = User::onlyTrashed()->where('id',$id)->first();

    if(empty($admin)) {
        return $this->error('','Invalid ID',404);
    }

    $admin->restore();

    return   $this ->success($admin,200,'Teacher Delete successfully');


  }

//...........................................................................................


//.............................................................................................
 public function  search_name($name){
    return User::where('name','like','%'.$name.'%')->get();
    $name->save();
  if($name)
    return   $this ->success($name,200,'The result search');

 }
 public function profile(){
    $user=auth()->user();
    if (!$user) {
        return $this->error('','cannot show anysthing',404);
    }
    $result[]=[
    'name'=>$user->name,
    'level'=>$user->level,
    'email'=>$user->email,
    'phone'=>$user->phone,

    ];
    return  $this->success($result,200,'');
 }

}
