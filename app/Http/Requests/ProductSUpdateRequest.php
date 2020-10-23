<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSUpdateRequest extends FormRequest
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
            // 'name' => 'required|string|unique:roles,name,'.$this->Suppler->name,
            'name' => 'required|string|regex:/(^([a-zA-Z]+)(\d+)?$)/u|unique:products,name,'.$this->Product->name,
            'material' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u|string',
            'style' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u|string',
            'color.*' => 'required',
            'sizeFrom' => 'required',
            'sizeTo' => 'required',
            'sellingPrice' => 'required|numeric',
            'upload_img' => 'sometimes|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];


    }
}
