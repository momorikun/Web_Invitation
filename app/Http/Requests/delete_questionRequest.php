<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class delete_questionRequest extends FormRequest
{
    protected $errorBag = 'delete_question';
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
            'delete_target_id'=> ['required', 'integer'],
            'delete_target_body' => ['required', 'string'],
        ];
    }
}
