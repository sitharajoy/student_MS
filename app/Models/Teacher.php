<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status'
    ];

    /**
     * get teacher details 
     */
    public function getTeacherList()
    {
        return Teacher::orderBy('id','desc')->get();
    }
}
