<?php

namespace PetNecro;

use Illuminate\Database\Eloquent\Model;

/**
 * PetNecro\Profile
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $zip
 * @property string $state
 * @property string $country
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \PetNecro\User $user
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereAddress1($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereAddress2($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\PetNecro\Profile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'city',
        'zip',
        'state',
        'country',
    ];

    /**
     * The profile belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
