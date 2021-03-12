<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        User::create([
            'name' => 'andreas',
            'email' => 'andreasyulianto3@gmail.com',
            'password' => Hash::make('123123'),
            'role' => 'sensei_001'
        ]);
    }
}
