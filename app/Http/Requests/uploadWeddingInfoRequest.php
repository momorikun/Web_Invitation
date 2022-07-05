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
            'groom_name'         => ['required', 'string'],
            'bride_name'         => ['required', 'string'],
            'attendance_contact_limit_day'=>['required', 'date'],
            'ceremonies_dates_year'  => ['required', 'date_format:"Y"'],
            'ceremonies_dates_month' => ['required', 'date_format:"m"'],
            'ceremonies_dates_day'   => ['required', 'date_format:"d"'],
            'ceremonies_reception_time'   => ['required', 'date_format:"H:i"'],
            'start_ceremonies_time'       => ['required', 'date_format:"H:i"'],
            'start_wedding_reception_time'=> ['required', 'date_format:"H:i"'],
            'place_name'         => ['required', 'string'],
            'place_state'        => ['required', 'string'],
            'place_city'         => ['required', 'string'],
            'place_address_line' => ['required', 'string'],
        ];
    }
}
