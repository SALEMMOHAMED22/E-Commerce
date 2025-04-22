<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name.*' => ['required' ,'string' , 'max:100' ,  UniqueTranslationRule::for('categories')->ignore($this->id)],
            'status' => ['required' , 'in:1,0,off,on'],
            'parent' =>['nullable' , 'exists:categories,id'],
            'icon' => ['nullable' , 'image' , 'mimes:jpg,jpeg,png' , 'max:2048'],
        ];
    }
}
