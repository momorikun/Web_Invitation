<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class getSearchedGuestRequest extends FormRequest
{
    protected $errorBag = 'getSearchedGuest';
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
            'id'                    => ['string', 'min:8', 'max:50', 'nullable'],
            'kana'                  => ['string', 'min:2', 'max:255', 'nullable'],
            'gender'                => ['string', 'nullable'],
            'whichSide'             => ['string', 'nullable'],
            'relationship'          => ['string', 'nullable'],
        ];
    }
}
