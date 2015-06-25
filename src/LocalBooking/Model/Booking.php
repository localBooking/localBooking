<?php

namespace LocalBooking\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'start',
        'end',
        'confirmed'
    ];

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
    ];

    public function resource()
    {
        return $this->belongsTo('LocalBooking\Model\Resource');
    }

}
