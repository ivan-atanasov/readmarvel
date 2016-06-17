<?php

namespace App\Http\Requests;

/**
 * Class MarvelListItemRequest
 * @package App\Http\Requests
 */
class MarvelListItemRequest extends Request
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
            'list_id'     => 'required|min: 1',
            'started_at'  => 'date',
            'finished_at' => 'date',
        ];
    }
}
