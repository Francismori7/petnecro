<?php

namespace PetNecro;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

/**
 * PetNecro\User
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
 * @property-read \PetNecro\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereStripeId($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereCardBrand($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\User whereTrialEndsAt($value)
 * @mixin \Eloquent
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
        return !!$this->profile;
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
}
