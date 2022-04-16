<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::truncate();
        $f = fopen(base_path("database/data/Teams.csv"), "r");

        while (($data = fgetcsv($f, 2000, ",")) !== FALSE) {
                Team::create([
                    "team_id" => Str::of($data['0'])->trim(),
                    "site" => Str::of($data['1'])->trim(),
                    "supervisor_id" => Str::of($data['2'])->trim()
                ]);
        }
        fclose($f);
    }
}
