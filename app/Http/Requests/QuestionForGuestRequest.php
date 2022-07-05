<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class QuestionForGuestRequest extends FormRequest
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
        return [
            'Q1forGuest' => ['required', 'string'],
            'Q2forGuest' => ['string', 'nullable'],
            'Q3forGuest' => ['string', 'nullable'],
            'Q4forGuest' => ['string', 'nullable'],
            'Q5forGuest' => ['string', 'nullable'],
        ];
    }
}
