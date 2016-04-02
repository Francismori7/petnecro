<?php

namespace Animociel\Http\Requests;

use Animociel\Http\Requests\Request;
use Animociel\User;

class UpdateAccountRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $password = $this->has('password') ? 'required|confirmed|min:6' : 'confirmed|min:6';
        return [
            'username' => "required|unique:users,username,{$this->user()->getKey()}|min:3|max:25",
            'email' => "required|email|max:255|unique:users,email,{$this->user()->getKey()}",
            'password' => $password,
        ];
    }
}
