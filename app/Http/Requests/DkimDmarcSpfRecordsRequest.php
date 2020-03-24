<?php

namespace App\Http\Requests;

use App\Rules\Domain;
use Illuminate\Foundation\Http\FormRequest;

class DkimDmarcSpfRecordsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'domain' => ['required', new Domain()],
        ];
    }

    public function messages()
    {
        return [
            'domain.required' => 'The domain is required.',
        ];
    }
}
