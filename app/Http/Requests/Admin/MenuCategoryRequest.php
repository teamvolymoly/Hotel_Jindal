<?php

namespace App\Http\Requests\Admin;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('menu_category')?->id;

        return [
            'parent_id' => [
                'nullable',
                Rule::exists('menu_categories', 'id')->where(fn (Builder $query) => $query->whereNull('parent_id')),
                Rule::notIn(array_filter([$categoryId])),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('menu_categories', 'name')
                    ->ignore($categoryId)
                    ->where(fn (Builder $query) => $query->where('parent_id', $this->input('parent_id'))),
            ],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
