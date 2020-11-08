<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required | max:255',
            'email' => 'required | max:255',
            'role' => 'required|not_in:Select Role',
            'organization' => 'required|not_in:Select Organization',
            'designation' => 'required|not_in:Select Designation'
        ];
    }

    public function messages()
    {
        return[
            'name.max' => 'Max chars 255',
        ];
    }
}
