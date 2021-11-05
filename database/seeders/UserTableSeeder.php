<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Str;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$data = [
    		[
                'name' => 'ThteaM',
                'email' =>'thteam47@gmail.com',
                'username' => 'thteam47',
                'password' => bcrypt('anhemtui123'),
                'otp' => '325', 
                'role' => '1'
            ],
            [
                'name' => 'ThteaM',
                'email' =>'thteam@gmail.com',
                'username' => 'thteam',
                'password' => bcrypt('anhemtui'),
                'otp' => '325', 
                'role' => '1'
            ],
        ];
    	//DB::table('users')->insert($data);

        DB::table('roles_user')->truncate();
        //User::truncate();
        $adminRoles = Roles::where('name','admin')->first();
        $sellerRoles = Roles::where('name','seller')->first();
        $userRoles = Roles::where('name','user')->first();
        $assistantRoles = Roles::where('name','assistant')->first();
        $admin = User::create([
            'name' => 'ThteaM',
            'email' =>'thteam47@gmail.com',
            'username' => 'thteam47',
            'password' => bcrypt('anhemtui123'),
            'remember_token' => Str::random(10),
            'active' => '0',
            'otp' => '0', 
            'phone' => '0961653561',
        ]);
        $seller = User::create([
            'name' => 'ThteaM seller',
            'email' =>'thteam@gmail.com',
            'username' => 'thteam',
            'password' => bcrypt('anhemtui'),
            'remember_token' => Str::random(10),
            'active' => '0',
            'otp' => '0',
            'phone' => '0961653561',
        ]);
        $assistant = User::create([
            'name' => 'ThteaM assistant',
            'email' =>'thteam11@gmail.com',
            'username' => 'thteam1',
            'password' => bcrypt('anhemtui'),
            'remember_token' => Str::random(10),
            'active' => '0',
            'otp' => '0',
            'phone' => '0961653561',
        ]);
        $user = User::create([
            'name' => 'ThteaM user',
            'email' =>'thteam12@gmail.com',
            'username' => 'thteam',
            'password' => bcrypt('anhemtui'),
            'remember_token' => Str::random(10),
            'active' => '0',
            'otp' => '0',
            'phone' => '0961653561',
        ]);
        $admin->roles()->attach($adminRoles);
        $seller->roles()->attach($sellerRoles);
        $assistant->roles()->attach($assistantRoles);
        $user->roles()->attach($userRoles);
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 100; $i++) { 
            $user = User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'username' => Str::random(8),
                'password' => bcrypt('anhemtui'),
                'remember_token' => Str::random(10),
                'active' => '0',
                'otp' => '0',
                'phone' => '0961653561',
            ]);
            $user->roles()->attach($userRoles);
        }
        User::factory()->count(40)->create();
    }
}
