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
    ];

    public function resource()
    {
        return $this->belongsToMany('LocalBooking\Model\Resource')->withPivot('options');
    }
}
