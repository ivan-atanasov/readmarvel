<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class StaticPageRequest
 * @package App\Http\Requests
 */
class StaticPageRequest extends Request
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
        $uniqueRule = 'unique:static_pages,url_slug';
        $uniqueRule .= $this->request->get('id') ? ',' . $this->request->get('id') : '';

        return [
            'title'    => 'required|unique:static_pages,url_slug',
            'url_slug' => 'required|alpha_dash|' . $uniqueRule,
            'content'  => 'required',
        ];
    }
}
