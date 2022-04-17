<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMetric extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'psid');
    }

    /**
     * returns the team that the user belongs to
     */
    public function team(){
        return $this->hasOne(Team::class,'team_id','team_id');
    }
}
