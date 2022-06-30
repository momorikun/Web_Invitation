<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Question_for_Bride_Request extends FormRequest
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
            'Q1forBride' => ['required', 'string'],
            'Q2forBride' => ['required', 'string'],
            'Q3forBride' => ['required', 'string'],
            'Q4forBride' => ['required', 'string'],
        ];
    }
}
