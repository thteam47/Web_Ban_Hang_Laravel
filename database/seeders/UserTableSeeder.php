<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
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
    			'password' => bcrypt('anhemtui123')
    		],
    		[
    			'name' => 'ThteaM',
    			'email' =>'thteam@gmail.com',
    			'username' => 'thteam',
    			'password' => bcrypt('anhemtui')
    		],
    	];
    	DB::table('users')->insert($data);
    }
}
