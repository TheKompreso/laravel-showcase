<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class APIFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        if (!str_starts_with($this->path(), 'api/')) {
            parent::failedValidation($validator);
        }

        throw new HttpResponseException(
            response()->json(
                [
                    'errors' => [
                        'fields' => $validator->errors(),
                    ],
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [],
            )
        );
    }
}
