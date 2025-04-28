<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title.*'      => ['required' , 'min:3' , 'max:100'],
            'content.*'    => ['required' , 'min:3' , 'max:100000'],
            'image'        => ['nullable' , 'image' , 'mimes:jpg,png,jpeg,giv,svg,webp' , 'max:2048'],
        ];
    }
}
