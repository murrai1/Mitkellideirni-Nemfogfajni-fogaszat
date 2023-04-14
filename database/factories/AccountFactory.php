<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $prefix = '$2y$';
        $cost = '10';
        $salt = '$mitkellideirnikerdojeltesztvezereltszoft$';
        $blowFishPrefix = $prefix.$cost.$salt;
        $password = 'korte';
        $hash = crypt( $password, $blowFishPrefix);

        return [

            "username" =>  $this->faker->userName(),
            "password" => $hash,
            "chategoryid" => 2 //$this->faker->numberBetween($min = 1, $max = 2),
        ];
    }
}
