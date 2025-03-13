<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required' , 'string' , 'max:255'],
            'email' => ['required' , 'email' , 'unique:users'],
            'password' => ['required' , 'string' , 'min:8', 'max:255'],
            'country_id' => ['required' , 'numeric' , 'exists:countries,id'],
            'governorate_id' => ['required' , 'numeric' , 'exists:governorates,id'],
            'city_id' => ['required' , 'numeric' , 'exists:cities,id'],
            'is_active' => ['required' , 'in:1,0'],
        ];
    }
}
