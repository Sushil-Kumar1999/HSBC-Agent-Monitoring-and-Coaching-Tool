<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum qualifier {
    case Good;
    case Medium;
    case Low;
}
class TeamMetric extends Model
{
    use HasFactory;
}
