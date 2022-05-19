<?php

namespace Database\Seeders;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert([
            'user_type' => Str::random(10),
            'user_id' => Str::random(10),
        ]);
    
    }

}
