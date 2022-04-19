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


    public function members(){
        return $this->hasMany(User::class,'team_id','team_id');
    }
}
