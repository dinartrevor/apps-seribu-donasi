<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
        ];
    }

    protected function prepareForValidation(): void
    {
        if(!request()->isMethod('PUT')){
            $this->merge([
                'created_by' => Auth::user()->id,
            ]);
        }else{
            $this->merge([
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
