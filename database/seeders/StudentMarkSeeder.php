<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StudentMarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check if table student_marks is empty
        if(DB::table('student_marks')->count() == 0){

            DB::table('student_marks')->insert([
    
                [
                    'student_id' => 1,
                    'subject_id' => 1,
                    'term_id' => 1,
                    'obtain_marks' => 40,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'student_id' => 1,
                    'subject_id' => 2,
                    'term_id' => 1,
                    'obtain_marks' => 45,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'student_id' => 1,
                    'subject_id ' => 3,
                    'term_id' => 1,
                    'obtain_marks' => 50,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
            
        } else { echo "Table is not empty"; }
    }
}
