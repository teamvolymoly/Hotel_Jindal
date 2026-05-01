<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuOrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'guest.name' => ['required', 'string', 'max:255'],
            'guest.room_no' => ['required', 'string', 'max:50'],
            'guest.phone' => ['required', 'string', 'max:20'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_item_id' => ['required', 'exists:menu_items,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
