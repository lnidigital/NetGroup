<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('contact-update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'company_name' => '',
            'email' => '',
            'address' => '',
            'zipcode' => 'max:6',
            'city' => '',
            'primary_number' => 'max:12',
            'secondary_number' => 'max:12',
            'industry_id' => ''
        ];
    }
}
