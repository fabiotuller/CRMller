<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Fábio Tuller',
            'email' => 'fabiotuller@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
