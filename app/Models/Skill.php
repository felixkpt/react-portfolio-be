<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory, CommonModelRelationShips;

    protected $fillable = [
        "name",
        "start_date",
        "skill_category_id",
        "experience_level_id",
        "image",
        "priority",
        "user_id",
        "status_id",
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
    
    function skillCategory()
    {
        return $this->belongsTo(SkillCategory::class);
    }

    function experienceLevel()
    {
        return $this->belongsTo(ExperienceLevel::class);
    }
}
