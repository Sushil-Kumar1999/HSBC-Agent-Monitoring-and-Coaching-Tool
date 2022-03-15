<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserMetrics;

class UserMetricsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        UserMetrics::truncate();
        $f = fopen(base_path("database/data/AgentMetrics.csv"), "r");
        $firstline = true;

        while (($data = fgetcsv($f, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                UserMetrics::create([
                    "psid" => $data['0'],
                    "qualifier" => $data['1'],
                    "ccpoh" => $data['2'],
                    "art" => $data['3'],
                    "nps" => $data['4'],
                    "fcr" => $data['5'],
                    "online_percentage" => $data['6']
                ]);    
            }
            $firstline = false;
        }
        fclose($f);
        //
    }
}
