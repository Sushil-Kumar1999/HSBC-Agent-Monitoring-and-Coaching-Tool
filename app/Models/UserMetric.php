<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMetric extends Model
{
    use HasFactory;


    /**
     * returns the team that the user belongs to
     */
    public function team(){
        return $this->belongsTo(Team::class,'team_id','team_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'psid');
    }

}
