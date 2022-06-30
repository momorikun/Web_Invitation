<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class guestInfoUpdateRequest extends FormRequest
{
    protected $errorBag = 'guestInfoUpdate';
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
            'updateId'        => ['required', 'string', 'min:8', 'max:50'],
            'updateName'      => ['required', 'string', 'max:255'],
            'updateKana'      => ['required', 'string', 'min:2', 'max:255'],
            'updateEmail'     => ['required', 'string', 'email', 'max:255'],
            'updateGiftMoney' => ['integer', 'nullable'],
            'updateRemarks'   => ['string', 'max:30', 'nullable'],
        ];
    }
}
