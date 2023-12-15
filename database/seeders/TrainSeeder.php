<?php

namespace Database\Seeders;

use App\Models\Train;
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

            [$departure, $arrival] = TrainSeeder::getCoherentDateTimes($faker);
            $new_train->departure_date = $departure;
            $new_train->arrival_date = $arrival;
            $new_train->departure_time = $departure;
            $new_train->arrival_time = $arrival;

            $new_train->train_number = $faker->bothify('?#?#?');
            $new_train->carriage_number = $faker->numberBetween(3, 12);
            $new_train->on_time = $faker->boolean();
            $new_train->cancelled = $faker->boolean();
            $new_train->save();
        }
    }

    private function getCoherentDateTimes($faker)
    {
        $departure = $faker->dateTimeBetween('-1 week', '+1 week');
        $arrival = $faker->dateTimeBetween($departure, date_modify(clone $departure, '3 days'));

        if (date_format($departure, 'y m d') == date_format($arrival, 'y m d')) {
            if (date_format($departure, 'H') > date_format($arrival, 'H')) {
                $arrival = $faker->dateTimeInInterval($departure, '+6 hours');
            }
        }

        return [$departure, $arrival];
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