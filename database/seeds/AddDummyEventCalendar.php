<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Schedule;

class AddDummyEventCalendar extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $data = [
                ['title' => 'Demo Event-1', 'start' => '2021-07-11', 'end' => '2021-07-12'],
                ['title' => 'Demo Event-2', 'start' => '2021-07-11', 'end' => '2021-07-13'],
                ['title' => 'Demo Event-3', 'start' => '2021-07-14', 'end' => '2021-07-14'],
                ['title' => 'Demo Event-3', 'start' => '2021-07-17', 'end' => '2021-07-17'],
            ];
            foreach ($data as $key => $value) {
                Schedule::create($value);
            }
    }
}
