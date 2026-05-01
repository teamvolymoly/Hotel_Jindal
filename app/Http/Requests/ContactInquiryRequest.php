<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'arrival_date' => ['required', 'date'],
            'departure_date' => ['required', 'date', 'after_or_equal:arrival_date'],
            'adults' => ['required', 'integer', 'min:1', 'max:20'],
            'children' => ['required', 'integer', 'min:0', 'max:20'],
            'room_category' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
            'agreed_to_terms' => ['accepted'],
        ];
    }
}
