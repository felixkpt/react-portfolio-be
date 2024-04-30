<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, CommonModelRelationShips;
    
    protected $fillable = [
        "name",
        "email",
        "message",
        "user_id",
        "status_id",
        "ip",
    ];
}
