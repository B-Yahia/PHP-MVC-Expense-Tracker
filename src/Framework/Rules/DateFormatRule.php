<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;


class DateFormatRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        $prasedDate = date_parse_from_format($params[0], $data[$field]);
        return $prasedDate['error_count'] === 0 && $prasedDate['warning_count'] === 0;
    }
    public function getMessage(array $data, string $field, array $params): string
    {
        return "The " . $field . " must be a valid date in format {$params[0]}";
    }
}
