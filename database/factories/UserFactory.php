<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => Str::random(8),
            'password' => bcrypt('anhemtui'),
            'remember_token' => Str::random(10),
            'active' => '0',
            'otp' => '0',
            'phone' => '0961653561',
        ];
    }
}
