<?php

namespace Animociel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AvailableSubscription extends Model
{
    protected $dates = [
        'created',
    ];

    protected $fillable = [
        'identifier',
        'amount',
        'interval',
        'interval_count',
        'name',
        'statement_descriptor',
        'created',
    ];

    public function setCreatedAttribute($value)
    {
        $this->attributes['created'] = Carbon::createFromTimestampUTC($value);
    }
}
