<?php

namespace App\Http\Requests\API;

class ProductsRequest extends APIFormRequest
{
    public function rules(): array
    {
        return [
            'properties' => [
                'nullable',
                'array',
            ],
            'properties.*' => [
                'nullable',
                'array',
            ],
            'properties.*.*' => [
                'nullable',
                'string',
            ],
            'per_page' => [
                'nullable',
                'integer',
                'min:1',
                'max:100',
            ],
        ];
    }
}
