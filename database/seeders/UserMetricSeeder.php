<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserMetric;
use Illuminate\Support\Str;

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
                    "team_id" => Str::of($data['0'])->trim(),
                    "psid" =>Str::of($data['1'])->trim(),
                    "site" => Str::of($data['2'])->trim(),
                    "qualifier" => Str::of($data['3'])->trim(),
                    "ccpoh" => Str::of($data['4'])->trim(),
                    "art" => Str::of($data['5'])->trim(),
                    "nps" => Str::of($data['6'])->trim(),
                    "fcr" => Str::of($data['7'])->trim(),
                    "online_percentage" => Str::of($data['8'])->trim()
                ]);    
        }
        fclose($f);
        //
    }
}
