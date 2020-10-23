<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        'name' => 'required|string|regex:/^[\p{L} ]+$/u|max:255',
        'email' => 'required|string|max:255|unique:users,email',
        'password' => 'required|confirmed|min:6',
        'departments' => 'required|exists:roles,name',
        'mobile' => 'required|string|numeric|min:11|unique:users,mobile',
        'address' => 'required|string|max:255',
        'gender' => 'required|in:Male,Female',
        'avatar' => 'sometimes|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'file' => 'sometimes|nullable|mimes:docx,pdf|max:2048',
        ];
    }
}
