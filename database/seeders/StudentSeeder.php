<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // check if table students is empty
       if(DB::table('students')->count() == 0){

        DB::table('students')->insert([

            [
                'name' => 'John Doe',
                'age' => 18,
                'gender' => 'M',
                'teacher_id' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Mary',
                'age' => 22,
                'gender' => 'F',
                'teacher_id' => 2,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
        
    } else { echo "Table is not empty"; }
    }
}
