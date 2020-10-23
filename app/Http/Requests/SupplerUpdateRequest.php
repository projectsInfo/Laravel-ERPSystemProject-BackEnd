<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplerUpdateRequest extends FormRequest
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
            'mobile.*' => 'required|unique:suppler_mobiles,mobile,'.$this->supplier_id.',suppler_id',
            'email.*' => 'required|unique:suppler_emails,email,'.$this->supplier_id.',suppler_id',
            'address.*' => 'required|unique:suppler_addresses,address,'.$this->supplier_id.',suppler_id',
        ];


    }
}
