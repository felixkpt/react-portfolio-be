<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceLevel extends Model
{
    use HasFactory, CommonModelRelationShips;

    protected $fillable = [
        "name",
        "priority",
        "user_id",
        "status_id",
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
