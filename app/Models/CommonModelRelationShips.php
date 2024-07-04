<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

trait CommonModelRelationShips
{
    function user()
    {
        return $this->belongsTo(User::class);
    }

    function status()
    {
        return $this->belongsTo(Status::class);
    }


    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Storage::url($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public static function boot()
    {
        parent::boot();
        static::creating(fn ($model) => defaultColumns($model));
    }
}
