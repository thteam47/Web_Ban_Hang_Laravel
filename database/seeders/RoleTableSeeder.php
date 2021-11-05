<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
    		[
    			'name' => 'admin',
    			
    		],
    		[
    			'name' => 'assistant',
    			
    		],
    		[
    			'name' => 'seller',
    			
    		],
    		[
    			'name' => 'user',
    			
    		],
    	];
    	DB::table('roles')->insert($data);
    }
}
