<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TeacherSeeder::class,
            TermSeeder::class,
            SubjectSeeder::class,
            StudentSeeder::class,
            StudentMarkSeeder::class,
          ]);
    }
}
