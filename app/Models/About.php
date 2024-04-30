<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory, CommonModelRelationShips;

    protected $table = 'about';
    
    protected $fillable = [
        "current_title",
        "name",
        "slug",
        "slogan",
        "introduction",
        "content",
        "image",
        "user_id",
        "status_id",
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
