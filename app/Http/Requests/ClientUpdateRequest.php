<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'mobile.*' => 'required|unique:mobile,mobile,'.$this->client_id.',client_id',
            'address.*' => 'required|unique:address,address,'.$this->client_id.',client_id',
        ];


    }
}
