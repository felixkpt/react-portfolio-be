<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory, CommonModelRelationShips;

    protected $fillable = [
        'institution',
        'course',
        'qualification',
        'start_date',
        'end_date',
        "image",
        'importance',
        'user_id',
        "status_id",
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
