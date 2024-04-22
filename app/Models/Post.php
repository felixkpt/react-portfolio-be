<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, CommonModelRelationShips;

    protected $fillable = [
        "title",
        "slug",
        "content",
        "content_short",
        "source_uri",
        "comment_disabled",
        "image",
        "status_id",
        "display_time",
        "importance",
        "user_id"
    ];
}
