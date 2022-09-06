<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerPreferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'prefered_annual_amount' => $this->faker->numberBetween($min = 100000, $max = 800000),
            'prefered_occupation' => implode(',', $this->faker->randomElements([OCCUPATION_TYPE_BUSINESS, OCCUPATION_TYPE_PRIVATE_JOB, OCCUPATION_TYPE_GOVERNMENT_JOB])),
            'prefered_family_type' => implode(',', $this->faker->randomElements([FAMILY_TYPE_JOINT, FAMILY_TYPE_NUCLEAR])),
            'prefered_manglik' => implode(',', $this->faker->randomElements([PREFERED_MANGLIK_YES, PREFERED_MANGLIK_NO, PREFERED_MAGLINK_BOTH])),
            
        ];
    }
}
