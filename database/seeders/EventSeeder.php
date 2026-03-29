<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $ali  = User::where('email', 'ali@test.com')->first();
        $talha = User::where('email', 'talha@test.com')->first();

        // Ali ky real events
        $aliEvents = [
            [
                'title'           => 'Laravel Workshop 2025',
                'description'     => 'Hands-on Laravel workshop for beginners and intermediate developers.',
                'location'        => 'Lahore, Pakistan',
                'event_date'  => now()->addDays(10),
                'total_seats'     => 50,
                'available_seats' => 50,
                'created_by'      => $ali->id,
            ],
            [
                'title'           => 'PHP Conference Karachi',
                'description'     => 'Annual PHP developers conference with talks and networking.',
                'location'        => 'Karachi, Pakistan',
                'event_date'  => now()->addDays(20),
                'total_seats'     => 100,
                'available_seats' => 100,
                'created_by'      => $ali->id,
            ],
            [
                'title'           => 'Vue.js Meetup Islamabad',
                'description'     => 'Monthly frontend meetup focusing on Vue.js ecosystem.',
                'location'        => 'Islamabad, Pakistan',
                'event_date'  => now()->addDays(5),
                'total_seats'     => 30,
                'available_seats' => 30,
                'created_by'      => $ali->id,
            ],
            [
                'title'           => 'DevOps Bootcamp',
                'description'     => 'Intensive 2-day bootcamp on Docker, CI/CD and cloud deployment.',
                'location'        => 'Lahore, Pakistan',
                'event_date'  => now()->addDays(15),
                'total_seats'     => 40,
                'available_seats' => 40,
                'created_by'      => $ali->id,
            ],
            [
                'title'           => 'React Native Summit',
                'description'     => 'Mobile development with React Native — talks and live demos.',
                'location'        => 'Karachi, Pakistan',
                'event_date'  => now()->addDays(25),
                'total_seats'     => 60,
                'available_seats' => 60,
                'created_by'      => $ali->id,
            ],
        ];

        foreach ($aliEvents as $event) {
            Event::create($event);
        }

        $locations = [
            'Lahore, Pakistan',
            'Karachi, Pakistan',
            'Islamabad, Pakistan',
            'Peshawar, Pakistan',
            'Multan, Pakistan',
            'Faisalabad, Pakistan',
        ];

        for ($i = 0; $i < 8; $i++) {
            $totalSeats = $faker->randomElement([20, 30, 40, 50, 75, 100]);

            Event::create([
                'title' => $faker->randomElement([
                    'Tech',
                    'Dev',
                    'Code',
                    'AI',
                    'Cloud',
                    'Web',
                    'Mobile',
                    'Data',
                ]) . ' ' . $faker->randomElement([
                    'Summit',
                    'Conference',
                    'Meetup',
                    'Workshop',
                    'Bootcamp',
                    'Hackathon',
                ]),
                'description'     => $faker->paragraph(2),
                'location'        => $faker->randomElement($locations),
                'event_date'  => $faker->dateTimeBetween('+5 days', '+60 days'),
                'total_seats'     => $totalSeats,
                'available_seats' => $totalSeats,
                'created_by'      => $talha->id,
            ]);
        }
    }
}
