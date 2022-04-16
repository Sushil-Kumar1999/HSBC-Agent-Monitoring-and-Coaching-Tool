<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        
        $f = fopen(base_path("database/data/Users.csv"), "r");
        $faker = Faker::create();

        while (($data = fgetcsv($f, 2000, ",")) !== FALSE) {
                User::create([
                    'id' => Str::of($data['0'])->trim(),
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'role' => Str::of($data['1'])->trim(),
                    'password' => Hash::make('password'), // password
                    'remember_token' => Str::random(10),
                ]);  
        }
        fclose($f);
    }
}
