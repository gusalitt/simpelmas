<?php

namespace App\Foundation\Routing;

class ErrorRoute
{
    private static string $controller = "";
    private static array $errorMapping = [];
    private static array $defaultError = [];

    public static function setController(string $controller): static
    {
        self::$controller = $controller;
        return new static();
    }

    public function when(int $errorCode, string $methodName): static
    {
        self::$errorMapping[$errorCode] = [self::$controller, $methodName];
        return new static();
    }

    public function otherwise(string $methodName): void
    {
        self::$defaultError = [self::$controller, $methodName];
    }

    public static function dispatch(int $errorCode): void
    {
        $handler = self::$errorMapping[$errorCode] ?? self::$defaultError ?? [];

        if (empty($handler)) {
            echo "Error $errorCode - Terjadi kesalahan";
            return;
        }

        [$controller, $methodName] = $handler;

        if (!class_exists($controller)) {
            echo "Error $errorCode - Terjadi kesalahan";
            return;
        }

        $instance = new $controller();

        if (!method_exists($instance, $methodName)) {
            echo "Error $errorCode - Terjadi kesalahan";
            return;
        }

        $response = $instance->$methodName();
        echo $response;
        return;
    }
}
