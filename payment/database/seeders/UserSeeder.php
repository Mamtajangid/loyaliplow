<?php

namespace Database\Seeders;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       
        for ($i=0; $i < 3; $i++) { 
	    	User::create([
	            'name' => str::random(8),
	            'email' => str::random(12).'@mail.com',
	            'password' => bcrypt('123456')
	        ]);
    	}
    }
}
