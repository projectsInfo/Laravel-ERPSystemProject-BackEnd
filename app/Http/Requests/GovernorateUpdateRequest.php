<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GovernorateUpdateRequest extends FormRequest
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
        // dd($this->governorate_id);
        return [
            'name' => 'required|string|max:255|unique:governorates,name,'.$this->governorate_id,
        ];
    }
}
