<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = [];

    public function coupon() {
        return $this->hasOne(Coupon::class);
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }
}
