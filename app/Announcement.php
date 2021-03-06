<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = [];

    protected $with = ['owner'];

    public function coupon() {
        return $this->hasOne(Coupon::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
