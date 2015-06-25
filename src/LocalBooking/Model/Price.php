<?php

namespace LocalBooking\Model;


use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'quantity',
        'price',
        'tax_rate'
    ];

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'resource_id'
    ];

    public function resource()
    {
        return $this->belongsTo('LocalBooking\Model\Resource');
    }
}
