<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserMetric;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

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
                    "psid" =>Str::of($data['0'])->trim(),
                    "site" => Str::of($data['1'])->trim(),
                    "qualifier" => Str::of($data['2'])->trim(),
                    "ccpoh" => Str::of($data['3'])->trim(),
                    "art" => Str::of($data['4'])->trim(),
                    "nps" => Str::of($data['5'])->trim(),
                    "fcr" => Str::of($data['6'])->trim(),
                    "online_percentage" => Str::of($data['7'])->trim()
                ]);    
        }
        fclose($f);

        //adds a fake history to each one
        foreach(UserMetric::get() as $metric){
            $timestamp = $metric->timestamp;
            $psid = $metric->psid;
            $site = $metric->site;
            $qualifier = $metric->qualifier;
            $ccpoh = $metric->ccpoh;
            $art = $metric->art;
            $nps = $metric->nps;
            $fcr = $metric->fcr;
            $online_percentage = $metric->online_percentage;
            for ($i=0; $i < rand(0,10); $i++) { 
                $timestamp = $timestamp-rand(1,7)*86400;
                $ccpoh = $this->getRandomPercentage($ccpoh);
                $art = $this->getRandomPercentage($art);
                $nps = $this->getRandomPercentage($nps);
                $fcr = $this->getRandomPercentage($fcr);
                $online_percentage = $this->getRandomPercentage($online_percentage);
                UserMetric::create([
                    'timestamp' => $timestamp,
                    "psid" => $psid,
                    "site" => $site,
                    "qualifier" => $qualifier,
                    "ccpoh" => $ccpoh,
                    "art" => $art,
                    "nps" => $nps,
                    "fcr" => $fcr,
                    "online_percentage" => $online_percentage
                ]);
                
            }
        }


        //
    }


    function getRandomPercentage($currentpercentage){
        $change = rand(0,100)/10;
        if(rand(0,1)==1){
            $currentpercentage = $currentpercentage + $change;
        }else{
            $currentpercentage = $currentpercentage - $change;
        }
        if($currentpercentage>100){
            return 100;
        }
        if($currentpercentage<0){
            return 0;
        }
        return $currentpercentage;
    }
}
