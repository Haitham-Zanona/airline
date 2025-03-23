<?php
namespace Database\Factories;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Airport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // قائمة IATA codes للمطارات الشائعة مع مدنها
        $commonAirports = [
            ['iata_code' => 'JFK', 'city' => 'New York', 'country' => 'United States', 'name' => 'John F. Kennedy International Airport'],
            ['iata_code' => 'LAX', 'city' => 'Los Angeles', 'country' => 'United States', 'name' => 'Los Angeles International Airport'],
            ['iata_code' => 'LHR', 'city' => 'London', 'country' => 'United Kingdom', 'name' => 'Heathrow Airport'],
            ['iata_code' => 'CDG', 'city' => 'Paris', 'country' => 'France', 'name' => 'Charles de Gaulle Airport'],
            ['iata_code' => 'DXB', 'city' => 'Dubai', 'country' => 'United Arab Emirates', 'name' => 'Dubai International Airport'],
            ['iata_code' => 'CAI', 'city' => 'Cairo', 'country' => 'Egypt', 'name' => 'Cairo International Airport'],
            ['iata_code' => 'RUH', 'city' => 'Riyadh', 'country' => 'Saudi Arabia', 'name' => 'King Khalid International Airport'],
            ['iata_code' => 'JED', 'city' => 'Jeddah', 'country' => 'Saudi Arabia', 'name' => 'King Abdulaziz International Airport'],
            ['iata_code' => 'IST', 'city' => 'Istanbul', 'country' => 'Turkey', 'name' => 'Istanbul Airport'],
            ['iata_code' => 'AUH', 'city' => 'Abu Dhabi', 'country' => 'United Arab Emirates', 'name' => 'Abu Dhabi International Airport'],
        ];

                                         // اختيار مطار عشوائي من القائمة، أو إنشاء مطار عشوائي
        if ($this->faker->boolean(80)) { // 80% فرصة لاختيار مطار معروف
            $airport = $this->faker->randomElement($commonAirports);
        } else {
            // إنشاء مطار عشوائي
            $airport = [
                'iata_code' => strtoupper($this->faker->unique()->lexify('???')),
                'city'      => $this->faker->city,
                'country'   => $this->faker->country,
                'name'      => $this->faker->city . ' International Airport',
            ];
        }

        return [
            'iata_code'  => $airport['iata_code'],
            'name'       => $airport['name'],
            'city'       => $airport['city'],
            'country'    => $airport['country'],
            'latitude'   => $this->faker->latitude,
            'longitude'  => $this->faker->longitude,
            'timezone'   => $this->faker->randomElement(['UTC+0', 'UTC+1', 'UTC+2', 'UTC+3', 'UTC+4', 'UTC-5', 'UTC-8']),
            'is_active'  => $this->faker->boolean(90), // معظم المطارات نشطة
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * تعريف حالة للمطارات المعروفة والمحددة
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function commonAirport()
    {
        return $this->state(function (array $attributes) {
            $commonAirports = [
                ['iata_code' => 'JFK', 'city' => 'New York', 'country' => 'United States', 'name' => 'John F. Kennedy International Airport'],
                ['iata_code' => 'LAX', 'city' => 'Los Angeles', 'country' => 'United States', 'name' => 'Los Angeles International Airport'],
                ['iata_code' => 'LHR', 'city' => 'London', 'country' => 'United Kingdom', 'name' => 'Heathrow Airport'],
                ['iata_code' => 'CDG', 'city' => 'Paris', 'country' => 'France', 'name' => 'Charles de Gaulle Airport'],
                ['iata_code' => 'DXB', 'city' => 'Dubai', 'country' => 'United Arab Emirates', 'name' => 'Dubai International Airport'],
                ['iata_code' => 'CAI', 'city' => 'Cairo', 'country' => 'Egypt', 'name' => 'Cairo International Airport'],
                ['iata_code' => 'RUH', 'city' => 'Riyadh', 'country' => 'Saudi Arabia', 'name' => 'King Khalid International Airport'],
                ['iata_code' => 'JED', 'city' => 'Jeddah', 'country' => 'Saudi Arabia', 'name' => 'King Abdulaziz International Airport'],
                ['iata_code' => 'IST', 'city' => 'Istanbul', 'country' => 'Turkey', 'name' => 'Istanbul Airport'],
                ['iata_code' => 'AUH', 'city' => 'Abu Dhabi', 'country' => 'United Arab Emirates', 'name' => 'Abu Dhabi International Airport'],
            ];

            $airport = $this->faker->randomElement($commonAirports);

            return [
                'iata_code' => $airport['iata_code'],
                'name'      => $airport['name'],
                'city'      => $airport['city'],
                'country'   => $airport['country'],
            ];
        });
    }
}