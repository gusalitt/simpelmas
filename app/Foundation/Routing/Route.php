<?php

namespace App\Foundation\Routing;

use App\Foundation\Routing\ErrorRoute;
use App\Foundation\Routing\Router;

class Route extends Router
{
    public static function prefix(string $prefix): static
    {
        self::$pendingPrefix = $prefix;
        return new static();
    }

    public function controller(string $controller): static
    {
        self::$pendingController = $controller;
        return new static();
    }

    public static function middleware(string|array $name): static
    {
        self::$routeMiddleware = array_merge(
            self::$routeMiddleware,
            self::resolveMiddleware($name)
        );

        return new static();
    }

    public function group(callable $callback): void
    {
        $previousPrefix = self::$groupPrefix;
        $previousController = self::$groupController;
        $previousMiddleware = self::$groupMiddleware;

        if (self::$pendingPrefix) {
            self::$groupPrefix = $previousPrefix
                ? rtrim($previousPrefix, '/') . '/' . trim(self::$pendingPrefix, '/')
                : self::$pendingPrefix;
            self::$pendingPrefix = "";
        }

        if (self::$pendingController) {
            self::$groupController = self::$pendingController;
            self::$pendingController = "";
        }

        self::$groupMiddleware = array_merge(
            self::$groupMiddleware,
            self::$routeMiddleware
        );
        self::$routeMiddleware = [];

        $callback();

        self::$groupPrefix = $previousPrefix;
        self::$groupController = $previousController;
        self::$groupMiddleware = $previousMiddleware;
    }

    public static function error(string $controller): ErrorRoute
    {
        return ErrorRoute::setController($controller);
    }

    public static function get(string $uri, array|string $action): void
    {
        self::addRoute('GET', $uri, $action);
    }

    public static function post(string $uri, array|string $action): void
    {
        self::addRoute('POST', $uri, $action);
    }
}
