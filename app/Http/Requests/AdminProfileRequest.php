<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check() && \Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'     => 'required',
            'new_password'     => 'required|min:3',
            'confirm_password' => 'required|min:3|same:new_password',
        ];
    }
}
