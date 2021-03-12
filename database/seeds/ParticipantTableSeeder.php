<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Participant;

class ParticipantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        for ($i=0; $i < 10; $i++) {
            $nik = $faker->unique()->numerify('################');
            $email = $faker->unique()->email();
            $name = $faker->unique()->name;
            $code = "PKKP2021/".$faker->unique()->numerify('####');
            $password = Hash::make($code);
            $role = "participant";
            $place = $faker->randomElement(['Pemalang', 'Demak']);

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => $role
            ]);
            Participant::create([
                'user_id' => $user->id,
                'nik' => $nik,
                'name' => $name,
                'place' => $place,
                'code' => $code
            ]);
        }
    }
}
