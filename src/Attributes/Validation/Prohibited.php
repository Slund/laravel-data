<?php

namespace Spatie\LaravelData\Attributes\Validation;

use Attribute;
use Illuminate\Validation\Rules\ProhibitedIf;
use Spatie\LaravelData\Support\Validation\Rules\FoundationProhibitedIf;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Prohibited extends ValidationAttribute
{
    public function __construct(private ?ProhibitedIf $rule = null)
    {
    }

    public function getRules(): array
    {
        return [$this->rule ?? static::keyword()];
    }

    public static function keyword(): string
    {
        return 'prohibited';
    }

    public static function create(string ...$parameters): static
    {
        return new self();
    }
}
