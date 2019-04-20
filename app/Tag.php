<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function announcement() {
        return $this->belongsToMany(Announcement::class);
    }

    public function stores() {
        return $this->hasMany(User::class);
    }

    public function owner() {
        return $this->belongsToMany(User::class, 'owner_id');
    }
}
