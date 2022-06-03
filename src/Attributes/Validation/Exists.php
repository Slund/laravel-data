<?php

namespace Spatie\LaravelData\Attributes\Validation;

use Attribute;
use Closure;
use Exception;
use Faker\Provider\Base;
use Illuminate\Validation\Rules\Exists as BaseExists;
use Spatie\LaravelData\Support\Validation\Rules\FoundationExists;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Exists extends ValidationAttribute
{
    private BaseExists $rule;

    public function __construct(
        ?string $table = null,
        ?string $column = 'NULL',
        ?string $connection = null,
        ?Closure $where = null,
        ?BaseExists $rule = null,
    ) {
        if ($rule === null && $table === null) {
            throw new Exception('Could not make exists rule since a table or rule is required');
        }

        $rule ??= new BaseExists(
            $connection ? "{$connection}.{$table}" : $table,
            $column
        );

        if ($where) {
            $rule->where($where);
        }

        $this->rule = $rule;
    }

    public function getRules(): array
    {
        return [$this->rule];
    }

    public static function keyword(): string
    {
        return 'exists';
    }

    public static function create(string ...$parameters): static
    {
        return new self(new BaseExists($parameters[0], $parameters[1] ?? null));
    }
}
