<?php

use Illuminate\Database\Seeder;
use App\TimeStatus;

class TimeStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TimeStatus::class, 1)->create();
    }
}
