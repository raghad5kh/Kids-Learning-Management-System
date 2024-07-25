<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Compliant;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\Validator;
use Exception;
class CompliantController extends Controller
{
    use GenTraits;
    public function index (){
        $compliants = Compliant::join('students','compliants.student_id','=','students.id')->where('type','=','false')->select('compliants.id','compliants.description','students.name')->get();
        return response()->json($compliants, 200);
         }


         public function indexsu (){
        $compliants = Compliant::join('students','compliants.student_id','=','students.id')->where('type','=','true')->select('compliants.id','compliants.description','students.name')->get();
        return response()->json($compliants, 200);
      }
    //..........................................................................................
    public function store(Request $request)
    {
          $student=auth()->user();
        $validator = Validator::make($request->all(),[
             'description' => 'required',
        ]);
        $save = new Compliant();
        $save->description = $request->description;
        $save->student_id = $student->id;
        $save->save();

        return $this->success($save,200,'Added a new Compliant successfully');

    }
    //...............................................................................................

    public function show($id)
    {

        try {
            $compliant = Compliant::find($id);

            if (!$compliant) {
                return $this->error('', 'compliant not found', 404);
            }


            return $this->success( $compliant , 200,'compliant found');
        } catch (Exception $ex) {
            return $this->error('', 'Cannot show compliant', 500);
        }
    }
    //................................................................................................
    public function solution($id) {
       $compliant =Compliant::find($id);
        $compliant->type = 'true';
        $compliant->save();

        return $this->success('',200,'Compliant successfully solution');


    }
}
