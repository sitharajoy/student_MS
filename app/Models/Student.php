<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'gender',
        'teacher_id',
        'status',
        'created_at',
        'updated_at'
    ];
    const STUDENT_STATUS = 1;

    /**
     * get teacher details 
     */
    public function teacher()
    {
        return $this->hasOne(Teacher::class,'id','teacher_id');
    }
    /**
     * get student marks 
     */
    public function marks()
    {
        return $this->hasMany(StudentMark::class,'student_id','id');
    }

    /**
     * get student details 
     */
    public function getStudentList()
    {
        return Student::orderBy('id','desc')->get();
    }

    /**
     * add student 
     */
    public function addStudent($request)
    {
        $studentDetails = Student::where('name',$request->name)
                                    ->exists();
        if(!$studentDetails)
        {
            $student = new Student();
            $student->name = $request->name;
            $student->age = $request->age;
            $student->gender = $request->gender;
            $student->teacher_id = $request->reporting_teacher;
            $student->status = SELF::STUDENT_STATUS;
            $student->save();
        }
        else{
            return false;
        }
        return true; 
    }

     /**
     * update student details
     * $requestData - request array 
     * $id-student id
     */
    public function updateStudentDetails($requestData, $id)
    {
         $student= Student::find($id);
        if($student)
        {
            $student->name = $requestData['name'];
            $student->age = $requestData['age'];
            $student->gender = $requestData['gender'];
            $student->teacher_id = $requestData['reporting_teacher'];
            $student->save();
        }
        else{
            return false;
        }
        return true; 
    }
}
