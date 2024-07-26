<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lt_course')->insert([
            [
                'name' => 'Course 1',
                'description' => 'This is Course 1',
                'teacher_id' => 1,
            ],
            [
                'name' => 'Course 2',
                'description' => 'This is Course 2',
                'teacher_id' => 2,
            ],
            [
                'name' => 'Course 3',
                'description' => 'This is Course 3',
                'teacher_id' => 1,
            ]
        ]);
    }
}
