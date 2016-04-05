<?php

namespace Animociel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Animociel\AvailableSubscription
 *
 * @property integer $id
 * @property string $identifier
 * @property integer $amount
 * @property string $interval
 * @property integer $interval_count
 * @property string $name
 * @property string $statement_descriptor
 * @property \Carbon\Carbon $created
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereIdentifier($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereInterval($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereIntervalCount($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereStatementDescriptor($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\AvailableSubscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
