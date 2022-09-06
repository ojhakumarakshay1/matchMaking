<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement([GENDER_TYPE_MALE, GENDER_TYPE_FEMALE]);

        return [
            'first_name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName($gender),
            'gender' => $gender,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
            'is_active' => true,
            'dob' => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31'),
            'annual_income' => $this->faker->numberBetween($min = 100000, $max = 800000),
            'occupation' => $this->faker->randomElement([OCCUPATION_TYPE_BUSINESS, OCCUPATION_TYPE_PRIVATE_JOB, OCCUPATION_TYPE_GOVERNMENT_JOB]),
            'family_type' => $this->faker->randomElement([FAMILY_TYPE_JOINT, FAMILY_TYPE_NUCLEAR]),
            'is_manglik' => $this->faker->randomElement([true, false]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
