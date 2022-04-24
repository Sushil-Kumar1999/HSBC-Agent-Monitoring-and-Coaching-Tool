<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserMetric;
use App\Models\Reward;
use App\Models\Team;

class User extends Authenticatable
{
    //protected $primaryKey = 'psid';
    public $incrementing = false;
    public ?array $middlewares = ['auth'];

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
        return $this->hasMany(UserMetric::class,'psid')->orderBy('timestamp', 'ASC');
    }
    
    /**
     * returns the team that the user supervises
     */
    public function supervises(){
        return $this->hasOne(Team::class,'supervisor_id');
    }

      /**
     * returns the team that the user is a part of
     */
    public function team() {
        return $this->belongsTo(Team::class,'team_id','team_id');
    }

     /**
     * returns all of the rewards that an agent has
     */
    public function rewards() {
        return $this->hasMany(Reward::class,'psid','id')->where('type', '=', 'reward')->orderBy('created_at', 'ASC');
    }

    /**
     * returns all of the skillbuilders that an agent has
     */
    public function skillbuilders() {
        return $this->hasMany(Reward::class,'psid','id')->where('type', '=', 'skillbuilder')->orderBy('created_at', 'ASC');
    }

    /**
     * returns all of the rewards that a supervisor has set
     */
    public function supervisorRewards() {
        return $this->hasMany(Reward::class,'id','supervisor_id');
    }
    
    /**
     * returns the score for the user
     */
    public function score(){
        $metrics = $this->metrics()->first();
        if($metrics !=null){
            return round(($metrics->ccpoh/.30)+($metrics->art/.30) +$metrics->nps+$metrics->fcr+$metrics->online_percentage,1);
        }
        return 0;
        
    }

    /**
     * returns a list of the web agents (for admin)
     */
    public function webAgents(){
        return User::where('role','agent')->get();
    }

    /**
     * returns a list of the supervisors (for admin)
     */
    public function supervisors(){
        return User::where('role','supervisor')->get();
    }

    /**
     * returns a list of the admins (for web agents & supervisors)
     */
    public function admins(){
        return User::where('role','admin')->get();
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
