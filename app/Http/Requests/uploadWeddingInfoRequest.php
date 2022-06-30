<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class uploadWeddingInfoRequest extends FormRequest
{
    protected $errorBag = 'uploadWeddingInfo';
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
            'upload_user_ceremony_id'=> ['required', 'string'],
            'ceremonies_dates_year'  => ['required', 'string'],
            'ceremonies_dates_month' => ['required', 'string'],
            'ceremonies_dates_day'   => ['required', 'string'],
            'ceremonies_dates_time'  => ['required', 'date_format:"H:i"'],
            'place_name'         => ['required', 'string'],
            'place_state'        => ['required', 'string'],
            'place_city'         => ['required', 'string'],
            'place_address_line' => ['required', 'string'],
        ];
    }
}
