<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplerOrderStoreRequest extends FormRequest
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
            'suppliers' => 'required|exists:supplers,id',
            'warehouses' => 'required|exists:users,id',
            'price.*' => 'required|numeric|min:1',
            'quantity.*' => 'required|numeric|min:1',
            'subproduct_id.*' => 'required|exists:Sub_Products,id',
        ];


    }
}
