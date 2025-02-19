<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class AttributeRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }

    protected $stopOnFirstFailure = true;
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name.*' => ['required' , 'string' , 'max:60' , UniqueTranslationRule::for('attributes')->ignore($this->id)],
            'value.*.*' => ['required' , 'string' , 'max:60'],
            
        ];
    }
}
