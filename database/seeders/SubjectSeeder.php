<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // check if table subjects is empty
       if(DB::table('subjects')->count() == 0){

        DB::table('subjects')->insert([

            [
                'subject_name' => 'Maths',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'subject_name' => 'Science',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'subject_name' => 'History',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
        
    } else { echo "Table is not empty"; }
    }
}
