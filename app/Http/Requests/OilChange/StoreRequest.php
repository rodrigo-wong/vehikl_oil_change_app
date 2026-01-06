<?php

namespace App\Http\Requests\OilChange;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'current_odometer' => 'required|integer|min:0|gte:prev_odometer',
            'prev_oil_change_date' => 'required|date|before:today',
            'prev_odometer' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'current_odometer.gte' => 'The current odometer reading must be greater than or equal to the previous odometer reading.',
        ];
    }
}
