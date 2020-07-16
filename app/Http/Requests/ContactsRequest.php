<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'required|email:rfc,dns',
            'emails_extra'  => 'nullable|email:rfc,dns'
        ];
    }

    public function messages()
    {
        return [
            'email.required'         => 'Este campo é obrigatório!',
            'email.email'            => 'Este não é um email válido!',
            'emails_extra.email'     => 'Este não é um email válido!'
        ];
    }
}

