<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderShippingRequest extends FormRequest
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
            'first_name'=>['required' , 'string' , 'max:100'],
            'last_name'=>['required' , 'string' , 'max:100'],
            'user_email'=>['required' , 'email' , 'max:100'],
            'user_phone'=>['required' , 'string' , 'max:100'],
            'country_id'=>['required' , 'numeric' , 'exists:countries,id'],
            'governorate_id'=>['required' , 'numeric' , 'exists:governorates,id'],
            'city_id'=>['required' , 'numeric' , 'exists:cities,id'],
            'street'=>['required' , 'string' , 'max:100'],
            'note'=>['nullable' , 'string' , 'max:100'],
            
            
        ];
    }
}
