<?php

namespace Spatie\LaravelData;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

interface RequestData
{
    public static function rules(): array;

    public static function messages(): array;

    public static function attributes(): array;

    public static function fromRequest(Request $request): static;

    public static function withValidator(Validator $validator): void;
}