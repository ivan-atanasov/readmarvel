<?php

namespace App\Http\Requests;

use Lang;

class CommentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'comment.required' => Lang::get('frontend/comments.validations.comment_required'),
        ];
    }
}
