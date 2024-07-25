<?php

namespace App\Http\Controllers;
 use App\Models\Student;
 use App\Models\Record;
 use App\Models\Main_level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

use LaravelJsonApi\Eloquent\Filters\OnlyTrashed;
 use App\Traits\GenTraits;

class RecordController extends Controller
{  use GenTraits;
    public function index (){
        $value = Cache::remember('records', 40, function () {
        return Record::all();
    });
    return $this ->success($value,200,'');


    }
    //...................................................................................

    public function store(Request $request)
    {
        $request->validate([
            'main_level_id' => 'required|exists:main_levels,id',
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'birthdate' => 'required',
        ]);

        // حفظ الطالب في قاعدة البيانات
        $student = new Record;
        $student->main_level_id = $request->main_level_id;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->phone = $request->phone;
        $student->id_number = mt_rand(1000,9999);
        $student->address = $request->address;
        $student->gender = $request->gender;
        $student->birthdate = Carbon::createFromFormat('d/m/Y', $request->birthdate)->format('Y-m-d');
        $student->save();
        return $this ->success($student,200,'Record student add successfully');

    }

    //...................................................................................
    // public function update(Request $request, $id)
    // {
    //     $reco = Record::find($id);
    //     if (!$reco) {
    //         return $this->error('','cannot show anysthing',500);
    //     }
    //     $validator = Validator::make($request->all(), [

    //         'birthdate' => 'required',
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'main_level_id' => 'required',
    //         'phone' => 'required',
    //         'address' => 'required',

    //     ]);

    //     if($request->first_name)
    //     {
    //         $reco->first_name = $request->first_name;
    //     }
    //     if($request->last_name)
    //     {
    //         $reco->last_name = $request->last_name;
    //     }

    //     if($request->birthdate)
    //     {
    //         $reco->birthdate = $request->birthdate;
    //     }

    //     if($request->main_level_id)
    //     {
    //         $reco->main_level_id = $request->main_level_id;
    //     }
    //     if($request->phone)
    //     {
    //         $reco->phone = $request->phone;
    //     }
    //     if($request->address)
    //     {
    //         $reco->address = $request->adress;
    //     }

    //     $reco->save();
    //     return $this ->success($reco,200,'Record updated successfully');

    // }
    public function  update_student(Request $request, $id){
        $record = Record::find($id);
        if (!$record) {
            return $this->error('','cannot show anysthing',500);
        }
        // $validator = Validator::make($request->all(), [

        //     'phone' => 'required',
        //     // 'level' => 'required',
        //     // 'email' => 'required',
        //     // 'password' => 'required',
        //     // 'phone' => 'required',


        // ]);
       // $input = $request->all();
        if($request->main_level_id )
        {
            $record->main_level_id  = $request->main_level_id ;
        }
        if($request->first_name)
        {
            $record->first_name = $request->first_name;
        }

        if($request->last_name)
        {
            $record->last_name = $request->last_name;
        }
        if($request->gender)
        {
            $record->gender = $request->gender;
        }
        if($request->birthdate)
        {
            $record->birthdate = Carbon::createFromFormat('d/m/Y', $request->birthdate)->format('Y-m-d');
        }
        if($request->phone)
        {
            $record->phone = $request->phone;
        }
        if($request->address)
        {
            $record->address = $request->address;
        }

        $record->save();
        return $this ->success($record,200,'record updated successfully');

    }

    //.....................................................................................
    public function soft_delete($id)
    {
        $record=  Record::find($id);
        if(empty($record)) {
           return ;
       }
      // $students = DB::table('students')->where('record_id', '=', $record->id)->first();
      $students= $record->student;
       $students_id=$students->id;
      $students->delete($students_id);
      $record->delete($id);
       return $this ->success('',200,' Record student Delete successfully');
    }
    //........................................................................................
    public function back_from_soft_delete($id)//فه حتى يعيد ماتم حذ
{
    $record = Record::onlyTrashed()->where('id',$id)->first();
    $student = Student::onlyTrashed()->where('record_id', '=', $record->id)->first();

    if(empty($record)) {
       return;
    }
    $record->restore();
    $student->restore();
    return   $this ->success(  $record,200,' record backs from Delete successfully');

}

//...........................................................................................
public function trashed_Student (){//لعرض الطلاب المحذوفين

        $student = Record::onlyTrashed()->get();//is  null deleted _at يعيد الاعمدة التي $student=OnlyTrashed ::make('trashed');
     return $student;
     return   $this ->success($student,200,'view delete');
    }

//.............................................................................................
public function  search_name($name){
    return Record::where('first_name','like','%'.$name.'%')->get();
 //   $name->save();
//    return   $this ->success($student,200,'the result search');
}



}
