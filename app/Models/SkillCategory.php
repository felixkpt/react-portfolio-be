<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    use HasFactory, CommonModelRelationShips;

    protected $fillable = [
        "name",
        "image",
        "priority_number",
        "user_id",
        "status_id"
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
