<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // check if table terms is empty
         if(DB::table('terms')->count() == 0){

            DB::table('terms')->insert([

                [
                    'term' => 'One',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'term' => 'Two',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
            
        } else { echo "Table is not empty"; }
    }
}
