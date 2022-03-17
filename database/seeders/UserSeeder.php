<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $f = fopen(base_path("database/data/Users.csv"), "r");
        $faker = Faker::create();

        while (($data = fgetcsv($f, 2000, ",")) !== FALSE) {
                User::create([
                    'psid' => $data['0'],
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'role' => $data['1'],
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => Str::random(10),
                ]);  
        }
        fclose($f);
    }
}
