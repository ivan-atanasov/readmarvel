<?php

namespace App\Http\Requests;

use Lang;

/**
 * Class UserProfileRequest
 * @package App\Http\Requests
 */
class UserProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'real_name' => 'regex:/^[\p{L}\s]*$/u',
            'about_me'  => 'max:140',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'real_name.regex' => Lang::get('frontend/profile.validations.real_name_regex'),
            'about_me.max'    => Lang::get('frontend/profile.validations.about_me_max'),
        ];
    }
}
