<?php

namespace Animociel;

use Illuminate\Database\Eloquent\Model;

/**
 * Animociel\Pet
 *
 * @property integer $id
 * @property string $name
 * @property string $race
 * @property string $birth_date
 * @property string $death_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Animociel\Pet whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\Pet whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\Pet whereRace($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\Pet whereBirthDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\Pet whereDeathDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\Pet whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\Pet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pet extends Model
{
    protected $dates = ['birth_date', 'death_date'];

    /**
     * The pet belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
