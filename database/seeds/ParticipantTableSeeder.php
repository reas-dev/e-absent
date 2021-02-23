<?php

use Illuminate\Database\Seeder;
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
        factory(Participant::class, 10)->create();
    }
}
