<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCompany extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','max:255'],
            'email' => ['nullable','email:rfc,dns','max:255'],
            'logo' => ['nullable','image','dimensions:min_width=100,min_height=100','max:1024'],
            'website' => ['nullable','url','max:255'],
        ];
    }
}
