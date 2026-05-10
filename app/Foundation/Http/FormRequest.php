<?php

namespace App\Foundation\Http;

class FormRequest extends Request
{
    protected array $validatedData = [];

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

    public function validate(): void
    {
        $rules = $this->rules();
        $data = $this->all();
        $errors = [];

        foreach ($rules as $field => $rule) {
            $fieldRules = explode('|', $rule);
            $value = $data[$field] ?? null;

            foreach ($fieldRules as $rule) {
                $error = $this->applyRule($field, $value, $rule, $data);
                if ($error) {
                    $errors[$field][] = $error;
                }
            }

            if (!isset($errors[$field])) {
                $this->validatedData[$field] = $value;
            }
        }

        if (!empty($errors)) {
            $this->onFailure($errors);
        }
    }

    protected function applyRule(string $field, mixed $value, string $rule, array $data): ?string
    {
        $messages = $this->messages();

        if ($rule === 'required' && ($value === null || $value === '')) {
            return $messages["{$field}.required"] ?? "{$field} is required.";
        }

        if ($rule === 'optional') {
            return null;
        }

        if ($rule === 'string' && $value !== null && !is_string($value)) {
            return $messages["{$field}.string"] ?? "{$field} must be a string.";
        }

        if ($rule === 'numeric' && $value !== null && !is_numeric($value)) {
            return $messages["{$field}.numeric"] ?? "{$field} must be a number.";
        }

        if ($rule === 'email' && $value !== null && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $messages["{$field}.email"] ?? "{$field} must be a valid email address.";
        }

        if ($rule === 'boolean' && $value !== null && !is_bool($value)) {
            return $messages["{$field}.boolean"] ?? "{$field} must be a boolean value.";
        }

        if ($rule === 'array' && $value !== null && !is_array($value)) {
            return $messages["{$field}.array"] ?? "{$field} must be an array.";
        }

        if ($rule === 'confirmed') {
            if (($data["{$field}_confirmation"] ?? null) !== $value) {
                return $messages["{$field}.confirmed"] ?? "{$field} confirmation does not match.";
            }
        }

        if ($rule === 'date' && $value !== null && !date_parse($value)) {
            return $messages["{$field}.date"] ?? "{$field} must be a valid date.";
        }

        if (str_starts_with($rule, 'min_length:')) {
            $min = (int) explode(':', $rule)[1];

            if ($value !== null && strlen((string) $value) < $min) {
                return $messages["{$field}.min_length"] ?? "{$field} must be at least {$min} characters long.";
            }
        }

        if (str_starts_with($rule, 'max_length:')) {
            $max = (int) explode(':', $rule)[1];

            if ($value !== null && strlen((string) $value) > $max) {
                return $messages["{$field}.max_length"] ?? "{$field} must be at most {$max} characters long.";
            }
        }

        if (str_starts_with($rule, 'min_items:')) {
            $min = (int) explode(':', $rule)[1];

            if ($value !== null && is_array($value) && count($value) < $min) {
                return $messages["{$field}.min_items"] ?? "{$field} must have at least {$min} items.";
            }
        }

        if (str_starts_with($rule, 'max_items:')) {
            $max = (int) explode(':', $rule)[1];

            if ($value !== null && is_array($value) && count($value) > $max) {
                return $messages["{$field}.max_items"] ?? "{$field} must have at most {$max} items.";
            }
        }

        if (str_starts_with($rule, 'min_value:')) {
            $min = (int) explode(':', $rule)[1];

            if ($value !== null && is_numeric($value) && $value < $min) {
                return $messages["{$field}.min_value"] ?? "{$field} must be at least {$min}.";
            }
        }

        if (str_starts_with($rule, 'max_value:')) {
            $max = (int) explode(':', $rule)[1];

            if ($value !== null && is_numeric($value) && $value > $max) {
                return $messages["{$field}.max_value"] ?? "{$field} must be at most {$max}.";
            }
        }

        if (str_starts_with($rule, 'in:')) {
            $allowed = explode(',', explode(':', $rule)[1]);
            if ($value !== null && !in_array($value, $allowed, true)) {
                return $messages["{$field}.in"] ?? "{$field} must be one of: " . implode(', ', $allowed) . ".";
            }
        }

        return null;
    }

    protected function onFailure(array $errors): void
    {
        session()->setFlash('errors', array_map(fn($messages) => $messages[0], $errors));
        session()->setFlash('old', $this->all());

        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
        exit;
    }

    public function validated(): array
    {
        return $this->validatedData;
    }
}
