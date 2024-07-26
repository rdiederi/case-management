<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lt_teacher')->insert([
            [
                'name' => 'Teacher 1',
                'id_number' => '9758468574584',
                'phone' => null,
            ],
            [
                'name' => 'Teacher 2',
                'id_number' => '3579514682587',
                'phone' => '0254685769',
            ],
        ]);
    }
}
