<?php

namespace Animociel;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

/**
 * Animociel\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $username
 * @property string $language
 * @property string $stripe_id
 * @property string $card_brand
 * @property string $card_last_four
 * @property string $trial_ends_at
 * @property-read \Animociel\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereStripeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereCardBrand($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereTrialEndsAt($value)
 * @mixin \Eloquent
 * @property integer $maximum_pets
 * @property-read \Illuminate\Database\Eloquent\Collection|\Animociel\Pet[] $pets
 * @method static \Illuminate\Database\Query\Builder|\Animociel\User whereMaximumPets($value)
 */
class User extends Authenticatable
{
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'language',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function hasFilledProfile()
    {
        return (bool)$this->profile;
    }

    /**
     * A user has a profile, but not as soon as he's registered.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Returns the profile picture link for the user.
     *
     * @see http://en.gravatar.com/site/implement/images/php/
     *
     * @param int $size
     * @return string
     */
    public function gravatarLink($size = 100)
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?d=retro&r=g&s=' . $size;
    }

    /**
     * A user may have many pets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    /**
     * $this->maximum_pets
     *
     * @param $value
     * @return
     */
    public function getMaximumPetsAttribute($value)
    {
        return $value;
    }

    public function taxPercentage()
    {
        return 14.97;
    }

    public function preferredCurrency()
    {
        return 'cad';
    }
}
