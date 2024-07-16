<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
            'event' => 'Cita #1',
            'start_date' => '2022-12-16 08:00',
            'end_date' => '2022-12-16 11:00',
            ],
            [
                'event' => 'Cita #2',
                'start_date' => '2022-12-17 09:00',
                'end_date' => '2022-12-17 12:00',
            ],
            [
                'event' => 'Cita #3',
                'start_date' => '2022-12-18 10:00',
                'end_date' => '2022-12-18 13:00',
            ],
            [
                'event' => 'Cita #4',
                'start_date' => '2022-12-19 11:00',
                'end_date' => '2022-12-19 14:00',
            ],
        ];
        foreach($events as $event){
            Event::create($event);
        }
    }
}
