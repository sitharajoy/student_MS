<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Subject;
use App\Models\Student;
use App\Models\StudentMark;
use Redirect,Response;

class StudentMarkController extends Controller
{
    /**
     * show student marks view.
     *
     * @return \Illuminate\Http\Response
     */
    public function addStudentView()
    {
        $termModel = new Term();
        $subjectModel = new Subject();
        $studentModel = new Student();

        $terms = $termModel->getTermList();
        $subjects = $subjectModel->getSubjectList();
        $students = $studentModel->getStudentList();

        $studentMarks = new StudentMark();
        $studentDetails = $studentMarks->getStudentMarks();

        return view('students.student_mark_list', 
                compact('terms','students','subjects','studentDetails'));
    }

    
   /**
     * add newly created student details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addStudentMarks(Request $request)
    {
        $request->validate([
            'student' => 'required',
            'term_id' => 'required',
            'row.*.obtain_marks' => 'required|max:255',
        ],[
            'student.required' => 'Student Name is required.',
            'term_id.required' => 'Standard is required.',
            'row.*.obtain_marks.required' => 'Obtain Marks is required.',
        ]);
        
        $storeData = new StudentMark;
        $storeData = $storeData->storeStudentMarks($request);
        if($storeData){
            return Redirect::to("/marks")->withSuccess('Marks added successfully'); 
        }else{
            return Redirect::to("/marks")->withError('Marks added already exists');
        }
       
    }

    /**
     * update student mark details view.
         *
         * @param  $id-student id
         * @param  $term-term
         * @return \Illuminate\Http\Response
     */
    public function updateStudentMarkView($id,$term)
    {
        $studentMarkModel = new StudentMark();
        $studentMarks = $studentMarkModel->getStudentMarkDetails($id,$term);                       
        return view('students.update_student_mark', compact('studentMarks'));
    }

    /**
     * update student mark details.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
     */
    public function updateStudentMark(Request $request)
    {
        $studentMark = new StudentMark;
        $updateData = $studentMark->updateStudentMarks($request);
        if($updateData)
        {
            return Redirect::to("/marks")->withSuccess('Marks updated successfully');
        }else{
            return Redirect::to("/marks")->withError('Error occured, marks are not updated');
        }
       
    }

    /**
     * delete student mark details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteStudentMark(Request $request)
    {
        $requestData = $request->all();
        $studentMark = new StudentMark;
        $updateData = $studentMark->deleteStudentMarks($requestData);
        
        return redirect('/marks')->with('success', 'Student mark data is successfully deleted');
    }
}
