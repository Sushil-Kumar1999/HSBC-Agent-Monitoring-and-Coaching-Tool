<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserMetric;
use App\Models\Team;

class User extends Authenticatable
{
    //protected $primaryKey = 'psid';
    public $incrementing = false;

    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * returns a list of the users metrics in order
     * of latest
     */
    public function metrics(){
        return $this->hasMany(UserMetric::class,'psid')->latest()->get();
    }
    
    /**
     * returns the team that the user belongs to
     */
    public function team(){
        return $this->belongsTo(Team::class,'team_id','team_id');
    }

    /**
     * returns the team that the user supervises
     */
    public function supervises(){
        return $this->hasOne(Team::class,'supervisor_id');
    }
    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
