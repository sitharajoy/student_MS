<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * get subject details 
     */
    public function getSubjectList()
    {
        return Subject::orderBy('id','desc')->get();
    }
}
