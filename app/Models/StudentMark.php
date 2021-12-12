<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class StudentMark extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','term_id','subject_id','obtain_marks','created_at','updated_at'];
    
    /**
     * Store a newly created student marks.
         *
         * @param  \Illuminate\Http\Request  $request
     */
    public function storeStudentMarks($request)
    {
        $requestArray = $request->all();
        $studentMarkDetails = $request->row;
        $insert_ary = [];
        
        foreach ($studentMarkDetails as $key => $value)
         {
            $markExists = StudentMark::where('student_id',$requestArray['student'])
                                    ->where('term_id',$requestArray['term_id'])
                                    ->where('subject_id',$value['subject_id'])
                                    ->exists();

             if(!$markExists){
                 $studentMark               = new StudentMark();
                 $studentMark->student_id   = $requestArray['student'];
                 $studentMark->term_id      = $requestArray['term_id'];
                 $studentMark->subject_id   = $value['subject_id'];
                 $studentMark->obtain_marks = $value['obtain_marks'];
                 $studentMark->save();
             }else{
                 return false;
             }                  
        }
        return true;   
    }
    /**
     * get term details 
     */
    public function terms()
    {
        return $this->hasOne(Term::class,'id','term_id');
    }
    /**
     * get subject details 
     */
    public function subjects()
    {
        return $this->hasOne(Subject::class,'id','subject_id');
    }

    /**
     * get student details 
     */
    public function students()
    {
        return $this->hasOne(Student::class,'id','student_id');
    }

    /**
     * get subject mark details 
     * $id - student_id
     * $term-term_id
     */
    public function getStudentMarkDetails($id, $term)
    {
        return StudentMark::with('students','subjects','terms')
                            ->where('student_id',$id)
                            ->where('term_id',$term)
                            ->get();
    }

    /**
     * update student marks
     */
    public function updateStudentMarks($request)
    {
        $requestArray = $request->all();
        $studentMarkDetails = $request->row;
        $updateArray = [];

        foreach ($studentMarkDetails as $key => $value) 
        {
            $updateArray['obtain_marks'] = $value['obtain_marks'];
            $data =  DB::table('student_marks')->where('id', '=',$value['mark_id'])->update($updateArray);
        }
         return true;  
    }

    /**get the student marks
     */
    public function getStudentMarks()
    {
        $studentList = StudentMark::with('students','terms','students.marks.terms')->groupBy('student_id','term_id')->get();
        return $studentList;
    }

    /**
     * delete subject mark details 
     * $id - student_id
     * $term-term_id
     */
    public function deleteStudentMarks($requestData)
    {
        $studentMark = StudentMark::where('student_id',$requestData['student_id'])->where('term_id',$requestData['term']);
        $studentMark->delete();
    }
}
