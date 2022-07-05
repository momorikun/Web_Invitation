<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class answer_questionsRequest extends FormRequest
{
    protected $errorBag = 'answer_questions';
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
            'id' => ['required', 'integer'],
            'answer_body' => ['required', 'string'],
        ];
    }
}
