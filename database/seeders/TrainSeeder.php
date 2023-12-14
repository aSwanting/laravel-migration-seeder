<?php

namespace Database\Seeders;

use App\Models\Train;
use DateTimeImmutable;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 100; $i++) {
            $new_train = new Train();

            $new_train->train_company = $faker->randomElement(['Trenitalia', 'Italo', 'Ferrovie del Gargano', 'Ferrovie Alpine']);
            $new_train->departure_station = $faker->city();
            $new_train->arrival_station = $faker->city();

            // Generate Start Date
            $new_train->departure_date = $faker->dateTimeBetween('now', '+1 week');

            // Generate Date Range
            $date_min = $new_train->departure_date;
            $date_max = date_modify(clone $date_min, '3 days');

            // Generate Arrival Date
            $new_train->arrival_date = $faker->dateTimeBetween($date_min, $date_max);

            // Generate Departure Time
            $new_train->departure_time = $faker->time();

            // Generate Arrival Time
            $new_train->arrival_time = $faker->time();

            // If train departs and arrives on the same day, make sure departure time < arrival time
            if (date_format($new_train->departure_date, 'y m d') == date_format($new_train->arrival_date, 'y m d')) {

                while ($new_train->arrival_time <= $new_train->departure_time) {
                    $new_train->arrival_time = $faker->time();
                }
            }

            $new_train->train_number = $faker->randomNumber(5, true);
            $new_train->carriage_number = $faker->numberBetween(3, 12);
            $new_train->on_time = $faker->boolean();
            $new_train->cancelled = $faker->boolean();
            $new_train->save();
        }
    }
}


// $table->string('train_company', 20);
// $table->string('departure_station', 100);
// $table->string('arrival_station', 100);
// $table->time('departure_time');
// $table->time('arrival_time');
// $table->date('departure_date');
// $table->date('arrival_date');
// $table->string('train_number', 5);
// $table->unsignedTinyInteger('carriage_number');
// $table->boolean('on_time')->default(true);
// $table->boolean('cancelled')->default(false);