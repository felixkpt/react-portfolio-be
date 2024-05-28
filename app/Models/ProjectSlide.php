<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSlide extends Model
{
    use HasFactory, CommonModelRelationShips, ExcludeSystemFillable;

    protected $fillable = [
        "project_id",
        "image",
        "caption",
        "priority",
        "user_id",
        "status_id",
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function project()
    {
        return $this->belongsTo(Project::class);
    }
}
