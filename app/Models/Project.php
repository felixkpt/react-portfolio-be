<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, CommonModelRelationShips, ExcludeSystemFillable;

    protected $fillable = [
        "title",
        "slug",
        "description",
        "achievements",
        "image",
        "project_url",
        "github_url",
        "company_id",
        "start_date",
        "end_date",
        "priority",
        "user_id",
        "status_id",

    ];

    protected $systemFillable = ['slug'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
    function company()
    {
        return $this->belongsTo(Company::class);
    }

    function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
