<?php

namespace PetNecro\Http\Requests;

use PetNecro\Http\Requests\Request;

class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasFilledProfile();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'max:255',
            'address1' => 'max:255',
            'address2' => 'max:255',
            'city' => 'max:255',
            'state' => 'max:255',
            'zip' => 'max:255',
            'country' => 'max:255',
        ];
    }
}
