<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
                    "team_id" => $data['0'],
                    "name" => $data['1'],
                    "supervisor_id" => $data['2']
                ]);
        }
        fclose($f);
    }
}
