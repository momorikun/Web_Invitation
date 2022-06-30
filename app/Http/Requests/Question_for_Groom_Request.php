<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Question_for_Groom_Request extends FormRequest
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
            'Q1forGroom' => ['required', 'string'],
            'Q2forGroom' => ['required', 'string'],
            'Q3forGroom' => ['required', 'string'],
            'Q4forGroom' => ['required', 'string'],
        ];
    }
}
