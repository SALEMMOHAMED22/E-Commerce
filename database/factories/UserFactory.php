<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $country = Country::inRandomOrder()->first();
        if(!$country){
            throw new \Exception('No Countries Found! Please Seed Country table');
        }
        $governorate = Governorate::inRandomOrder()->first();
        if(!$governorate){
            throw new \Exception('No Governorates Found! Please Seed governorate table');
        }
        // $city = City::inRandomOrder()->first();
        // if(!$city){
        //     throw new \Exception('No city Found! Please Seed city table');
        // }
        



        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),

            'is_active' => 1,
            'country_id' => $country->id,
            'governorate_id' => $governorate->id,
            'city_id' => random_int(1,200),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
