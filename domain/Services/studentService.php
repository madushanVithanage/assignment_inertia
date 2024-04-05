<?php

namespace domain\Services;

use App\Models\Student;
use App\Http\Controllers\fileUploader;
use Inertia\Inertia;

class studentService{

    //constructor
    protected $student_ins;
    protected $file_ins;
    public function __construct(){
       $this->student_ins = new Student();
       $this->file_ins = new fileUploader();
    }

    //dashboard load with all student
    public function view_all(){
        return $this->student_ins->all();
    }

    public function studentList(){
        return $this->student_ins->all();
    }

    //store student
    public function saveStudent($request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:100|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $student =$this->student_ins;
        $student->name = $request->name;
        $student->age = $request->age;

        if ($request->hasFile('image')) {
            $student->image = $this->file_ins->file_up($request,'image','uploads/images');
        }else{
            $student->image = null;
        }
    
        $student->status = 1;
        $student->save();
       
    }
    
    //delete function
    public function deleteStudent($student_id)
    {

       $result = $this->student_ins->find($student_id);
       $result->delete();
       
    }

    //view edit data
    public function viewEditData($student_id)
    {
        return $this->student_ins->find($student_id);
    }

    //update edit data
    public function updateStudent($request, $student_id)
    {

       $request->validate([
        'name' => 'required|string|max:255',
        'age' => 'required|integer|min:0|max:100|integer',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

       $result = $this->student_ins->where('id','=',$student_id)
       ->update([
           'name' => $request['name'],
           'age' => $request['age'],
           'image' =>  $this->file_ins->file_up($request,'image','uploads/images'),
           'status' => $request['status'],
       ]);
       
    }

}