<?php

namespace App\Foundation\Traits;

use App\Foundation\Http\Request;
use App\Foundation\Http\FormRequest;

trait HasRequest
{
    private Request $currentRequest;

    public function prepareRequest(string $action): void
    {
        if (!isset($this->requests[$action])) {
            $this->currentRequest = new Request();
            return;
        }

        $requestClass = $this->requests[$action];

        if (!class_exists($requestClass)) {
            throw new \RuntimeException("FormRequest class '{$requestClass}' not found.");
        }

        if (!is_subclass_of($requestClass, FormRequest::class)) {
            throw new \RuntimeException("FormRequest class '{$requestClass}' must extend FormRequest.");
        }

        $request = new $requestClass();
        $request->validate();

        $this->currentRequest = $request;
    }

    public function requests(): Request
    {
        return $this->currentRequest;
    }

    public function validated(): array
    {
        if (!$this->currentRequest instanceof FormRequest) {
            throw new \RuntimeException("validated() called but no FormRequest assigned to this action.");
        }

        return $this->currentRequest->validated();
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->currentRequest->input($key, $default);
    }

    public function all(): array
    {
        return $this->currentRequest->all();
    }

    public function has(string $key): bool
    {
        return $this->currentRequest->has($key);
    }

    public function only(array $keys): array
    {
        return $this->currentRequest->only($keys);
    }

    public function except(array $keys): array
    {
        return $this->currentRequest->except($keys);
    }
}
