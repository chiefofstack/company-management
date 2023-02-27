<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEmployee extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'regex:"^[a-zA-Z ,.\'-]+$"','max:255'],
            'last_name' => ['required', 'regex:"^[a-zA-Z ,.\'-]+$"','max:255'],
            'email' => ['nullable','email:rfc,dns','max:255'],
            'phone_number' => ['nullable','regex:"^(\+{0,1}\d{1,3}[\s.-]?)?\(?\d{3,5}\)?[\s.-]?\d{3}[\s.-]?\d{3,4}$"'],
            'company_id' => ['nullable'],
        ];
       
    }
}
