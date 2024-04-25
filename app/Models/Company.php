<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, CommonModelRelationShips;
    
    protected $fillable = [
        "name", "slug", "url", 'image',
        'roles',
        'start_date',
        'end_date',
        'priority_number',
        "user_id",
        "status_id",
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
