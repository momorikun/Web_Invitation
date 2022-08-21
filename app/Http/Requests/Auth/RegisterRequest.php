<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    protected $errorBag = 'register';
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
        return [
            'name'                  => ['required', 'string', 'max:255'],
            'kana'                  => ['required', 'string', 'min:2', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
            'gender'                => ['string', 'nullable'],
            'is_bride_side'         => ['string', 'nullable'],
            'relationship'          => ['string', 'nullable'],
            'ceremonies_id'         => ['required', 'string', 'min:8', 'max:50'],
        ];
    }
}
