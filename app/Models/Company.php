<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, CommonModelRelationShips, ExcludeSystemFillable;

    protected $fillable = [
        "name", 
        "slug",
        "website",
        'position',
        'roles',
        'start_date',
        'end_date',
        'priority',
        'image',
        "user_id",
        "status_id",
    ];

    protected $systemFillable = ['slug'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
