<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Team extends Model
{
    protected $primaryKey = 'team_id';
    public $incrementing = false;
    use HasFactory;

    public function supervisor() {
        return $this->belongsTo(User::class,'supervisor_id','id');
    }

    public function score(){
        $members = $this->members()->get();
        if(sizeof($members)==0){
            return 0;
        }
        $total =0.0;
        foreach($members as $member){
            $total += $member->score();
        }
        return round($total/sizeof($members),1);
    }

    public function members(){
        return $this->hasMany(User::class,'team_id','team_id');
    }
}
