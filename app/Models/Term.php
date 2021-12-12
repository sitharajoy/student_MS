<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    /**
     * get term details 
     */
    public function getTermList()
    {
        return Term::orderBy('id')->get();
    }
}
