<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientValidation extends FormRequest
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
            'short_text' => 'required',
            'clients_photo' => 'required',
        ];
    }
}
