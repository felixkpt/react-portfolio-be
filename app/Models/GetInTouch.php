<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetInTouch extends Model
{
    use HasFactory, CommonModelRelationShips;

    protected $fillable = [
        'name',
        'link',
        'image',
        'priority',
        'user_id',
        "status_id",
    ];
    
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
