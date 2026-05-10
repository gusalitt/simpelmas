<?php

namespace App\Foundation\Support;

class Session
{
    private ?string $prefix = null;
    private string $flashKey = '_flash';

    public function __construct(?string $prefix = null)
    {
        if (!empty($prefix)) {
            $this->prefix = $prefix;
        }
    }

    protected function formatKey(string $key): string
    {
        return $this->prefix
            ? $this->prefix . '.' . $key
            : $key;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $segments = explode('.', $this->formatKey($key));
        $value = $_SESSION;

        foreach ($segments as $segment) {
            if (is_array($value) && array_key_exists($segment, $value)) {
                $value = $value[$segment];
            } else {
                return $default;
            }
        }

        return $value;
    }

    public function set(string $key, mixed $value): void
    {
        $segments = explode('.', $this->formatKey($key));
        $data = &$_SESSION;

        foreach ($segments as $index => $segment) {
            if ($index === array_key_last($segments)) {
                $data[$segment] = $value;
            } else {
                if (!isset($data[$segment]) || !is_array($data[$segment])) {
                    $data[$segment] = [];
                }
                $data = &$data[$segment];
            }
        }
    }

    public function has(string $key): bool
    {
        $segments = explode('.', $this->formatKey($key));
        $data = $_SESSION;

        foreach ($segments as $segment) {
            if (!isset($data[$segment])) {
                return false;
            }
            $data = $data[$segment];
        }

        return true;
    }

    public function remove(string $key): void
    {
        $segments = explode('.', $this->formatKey($key));
        $data = &$_SESSION;

        foreach ($segments as $index => $segment) {
            if (!is_array($data) || !array_key_exists($segment, $data)) {
                return;
            }

            if ($index === array_key_last($segments)) {
                unset($data[$segment]);
                return;
            }

            $data = &$data[$segment];
        }
    }

    public function getFlash(string $key, mixed $default = null): mixed
    {
        $fullKey = $this->flashKey . '.' . $key;
        $value = $this->get($fullKey, $default);

        $this->remove($fullKey);
        return $value;
    }

    public function setFlash(string $key, mixed $value): void
    {
        $fullKey = $this->flashKey . '.' . $key;
        $this->set($fullKey, $value);
    }

    public function removeFlash(string $key): void
    {
        $fullKey = $this->flashKey . '.' . $key;
        $this->remove($fullKey);
    }
}
