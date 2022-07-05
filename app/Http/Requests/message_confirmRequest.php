<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class message_confirmRequest extends FormRequest
{
    protected $errorBag = 'message_confirm';
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
            'message_for_couple' => ['required', 'string'],
        ];
    }
}
