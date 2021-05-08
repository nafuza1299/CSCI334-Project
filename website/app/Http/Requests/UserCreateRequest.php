<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:190|unique:users',
            'email' => 'required|string|email|max:190',
            'password' => 'required|string|confirmed|min:8|max:190',
            'first_name' => 'required|string|max:190',
            'last_name' => 'required|string|max:190',
            'address' => 'nullable|string|max:190',
            'phone_number' => 'nullable|numeric|digits_between:8,12',
            'date_of_birth' => 'nullable|date',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
