<?php

namespace LocalBooking\Model;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'name',
        'description',
        'media',
        'enabled'
    ];

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
    ];

    public function prices()
    {
        return $this->hasMany('LocalBooking\Model\Price');
    }

    public function bookings()
    {
        return $this->hasMany('LocalBooking\Model\Booking');
    }


}
