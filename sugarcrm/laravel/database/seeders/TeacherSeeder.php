<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lt_student')->insert([
            [
                'name' => 'Student 1',
                'id_number' => '958745869521',
                'phone' => null,
            ],
            [
                'name' => 'Student 2',
                'id_number' => '2546854687458',
                'phone' => '0254685769',
            ],
            [
                'name' => 'Student 3',
                'id_number' => '1807180000000',
                'phone' => '0586479685',
            ]
        ]);
    }
}
