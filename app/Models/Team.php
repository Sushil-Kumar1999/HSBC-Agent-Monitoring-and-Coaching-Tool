<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $primaryKey = 'team_id';
    public $incrementing = false;
    use HasFactory;

    public function supervisor() {
        return $this->belongsTo(User::class,'supervisor');
    }

    public function members(){
        return $this->hasMany(UserMetric::class,'team_id','team_id')->distinct();
    }
}
