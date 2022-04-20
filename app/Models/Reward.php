<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    public function owner() {
        return $this->belongsTo(User::class,'psid','id');
    }
    public function supervisor() {
        return $this->belongsTo(User::class,'supervisor_id','id');
    }
}
