<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')-> insert([[
            'name' => 'Đào Xuân Hùng',
            'email' => 'xuanhung2401@gmail.com',
            'password' => bcrypt('1234567'),
        ], [
            'name' => 'Đào Linh',
            'email' => 'daolinh2401@gmail.com',
            'password' => bcrypt('1234567'),
        ], [
            'name' => 'Thanh Tùng',
            'email' => 'thanhtung@gmail.com',
            'password' => bcrypt('1234567'),
        ]]);

    }
}
