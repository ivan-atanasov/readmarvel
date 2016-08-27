<?php

namespace App\Http\Requests;

use Lang;

/**
 * Class ContactFormRequest
 * @package App\Http\Requests
 */
class ContactFormRequest extends Request
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
            'email'   => 'required|email',
            'name'    => 'required|min:2',
            'subject' => 'required',
            'content' => 'required|min:10',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'   => Lang::get('frontend/contact.validations.email_required'),
            'email.email'      => Lang::get('frontend/contact.validations.email_email'),
            'name.required'    => Lang::get('frontend/contact.validations.name_required'),
            'name.min'         => Lang::get('frontend/contact.validations.name_min'),
            'subject.required' => Lang::get('frontend/contact.validations.subject_required'),
            'content.required' => Lang::get('frontend/contact.validations.content_required'),
            'content.min'      => Lang::get('frontend/contact.validations.content_min'),
        ];
    }
}
