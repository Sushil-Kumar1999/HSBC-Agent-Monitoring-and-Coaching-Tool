<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserMetric;

class UserMetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        UserMetric::truncate();

        $f = fopen(base_path("database/data/AgentMetrics.csv"), "r");

       

        while (($data = fgetcsv($f, 2000, ",")) !== FALSE) {
                UserMetric::create([
                    'timestamp' => time(),
                    "team_id" => $data['0'],
                    "psid" => $data['1'],
                    "site" => $data['2'],
                    "qualifier" => $data['3'],
                    "ccpoh" => $data['4'],
                    "art" => $data['5'],
                    "nps" => $data['6'],
                    "fcr" => $data['7'],
                    "online_percentage" => $data['8']
                ]);    
        }
        fclose($f);
        //
    }
}
