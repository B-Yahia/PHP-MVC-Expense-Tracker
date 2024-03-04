<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class MatchRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        $fieldOne = $data[$params[0]];
        $fieldTwo = $data[$field];
        return $fieldOne === $fieldTwo;
    }
    public function getMessage(array $data, string $field, array $params): string
    {
        return "Does not match with " . $params[0];
    }
}
