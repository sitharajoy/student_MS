<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Redirect,Response;

class StudentController extends Controller
{

    /**
     * Display a listing of the students details.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacherModel = new Teacher();
        //students list
        $students = Student::with('teacher')->orderBy('id','desc')->get();
        //teacher details
        $teachers = $teacherModel->getTeacherList();
        return view('students.students_list', compact('students', 'teachers'));
    }

    /**
     * Store a newly created student details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addStudent(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'age'=> 'required',
            'gender'=> 'required',
            'reporting_teacher' => 'required'
        ]);
        
        //add student
        $student = new Student();
        $addStudent = $student->addStudent($request);
        if($addStudent)
        {
            return Redirect::to("/")->withSuccess('Student added successfully');
        }
        else{
            return Redirect::to("/")->withError('Student data already exists');
        }
        
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param  $id- student id
     * @return \Illuminate\Http\Response
     */
    public function updateStudentView($id)
    {
        //get student detail
        $studentDetails = Student::findOrFail($id);
        $teacherModel = new Teacher();
        //teacher details
        $teachers = $teacherModel->getTeacherList();
        return view('students.update_students', compact('studentDetails', 'teachers')); 
    }

    /**
     * Update the specified student.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  $id- student id
     * @return \Illuminate\Http\Response
     */
    public function updateStudent($id,Request $request)
    {
        $requestData = $request->all();
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'reporting_teacher' => 'required',
        ]);

        //update student
            $studentModel = new Student();
            $updateStudent = $studentModel->updateStudentDetails($requestData,$id);

            if($updateStudent)
            {
                return redirect()->route('studentList')
                                ->with('success','Student has been updated successfully.');
            }
            else{
                return redirect()->route('studentList')
                                ->with('error','Invalid student details.');
            }
           
    }

    /**
     * delete student
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteStudent(Request $request)
    {
        $requestData = $request->all();
        $student = Student::findOrFail($requestData['student_id']);
        $student->delete();
        return redirect('/')->with('success', 'Student data is successfully deleted.');
    }
}
