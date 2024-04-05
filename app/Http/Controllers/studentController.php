<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use domain\Facades\studentFacade;
use App\Models\Student;
use App\Http\Controllers\fileUploader;

class studentController extends Controller
{
    //constructor
    protected $student_ins;
    protected $file_ins;
    public function __construct(){
       $this->student_ins = new Student();
       $this->file_ins = new fileUploader();
    }

    //dashboard load with all student
    public function view_all(){
        $all_data['all_student'] = studentFacade::view_all();
        return inertia::render('Dashboard/index', $all_data);
    }

    public function studentList(){
        $all_data =studentFacade::studentList();
        return response()->json($all_data);
    }

    //store student
    public function saveStudent(Request $request)
    {
        studentFacade::saveStudent($request);
       
    }
    
    //delete function
    public function deleteStudent($student_id)
    {

       studentFacade::deleteStudent($student_id);
       
    }

    //view edit data
    public function viewEditData($student_id)
    {
       $result['all_data'] = studentFacade::viewEditData($student_id);
       return inertia::render('Edit/index', $result);
       
    }

    public function updateStudent(Request $request, $student_id)
    {
        studentFacade::updateStudent($request, $student_id);
       
    }
}
