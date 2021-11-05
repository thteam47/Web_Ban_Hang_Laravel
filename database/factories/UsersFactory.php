<?php

use App\Models\User;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
class UsersFactory extends Factory
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
$factory->define(User::class, function(Faker $faker){
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
});
$factory->afterCreating(User::class,function ($user,$faker) {
    $roles = Roles::where('name','user')->get();
    $user->roles()->sync($roles->pluck('id_roles')->toArray());
});

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */


