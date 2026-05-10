<?php

namespace App\Foundation\Routing;

use App\Foundation\Http\Controller;
use App\Foundation\Support\Logger;

class Router
{
    protected static array $routes = [];
    protected static string $groupController = '';
    protected static string $pendingController = '';
    protected static string $groupPrefix = '';
    protected static string $pendingPrefix = '';

    protected static array $groupMiddleware = [];
    protected static array $routeMiddleware = [];
    protected static array $middlewareRegistry = [];

    public static function setMiddlewareRegistry(array $register): void
    {
        self::$middlewareRegistry = $register;
    }

    protected static function addRoute(string $method, string $uri, array|string $action)
    {
        [$controller, $methodName] = self::resolveAction($action);

        $middlewares = array_merge(self::$groupMiddleware, self::$routeMiddleware);

        self::$routeMiddleware = [];
        self::$routes[] = [
            'method' => $method,
            'uri' => self::resolveUri($uri),
            'controller' => $controller,
            'action' => $methodName,
            'middlewares' => $middlewares,
        ];
    }

    protected static function resolveUri(string $uri): string
    {
        $full = self::$groupPrefix . '/' . trim($uri, '/');
        return '/' . trim($full, '/') ?: '/';
    }

    protected static function resolveMiddleware(string|array $names): array
    {
        $names = is_array($names) ? $names : [$names];

        return array_map(function (string $name) {
            if (!isset(self::$middlewareRegistry[$name])) {
                throw new \InvalidArgumentException("Middleware '$name' not found in registry.");
            }

            return self::$middlewareRegistry[$name];
        }, $names);
    }

    protected static function resolveAction(array|string $action): array
    {
        if (is_array($action) && count($action) === 2) {
            return $action;
        }

        $method = is_array($action) ? $action[0] : $action;

        if (self::$groupController) {
            return [self::$groupController, $method];
        }

        throw new \InvalidArgumentException("Cannot resolve action '{$method}': no controller specified.");
    }

    public static function dispatch()
    {
        // CLI mode
        if (php_sapi_name() === 'cli') {
            return;
        }

        $requestUri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $routeUri = rtrim($route['uri'], '/');
            preg_match_all('/\{([^}]+)\}/', $routeUri, $paramNames);

            $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $routeUri);
            $pattern = "#^" . $pattern . "$#";

            if (
                $route['method'] === $requestMethod &&
                preg_match($pattern, $requestUri, $matches)
            ) {
                array_shift($matches);
                $params = array_combine($paramNames[1], $matches);

                self::runMiddlewares($route['middlewares'], function () use ($route, $params) {
                    self::callController($route['controller'], $route['action'], $params);
                });

                return;
            }
        }

        return ErrorRoute::dispatch(404);
    }

    private static function runMiddlewares(array $middlewares, callable $final): void
    {
        $chain = array_reduce(
            array_reverse($middlewares),
            function (callable $carry, string $middlewareClass) {
                return function () use ($carry, $middlewareClass) {
                    if (!class_exists($middlewareClass)) {
                        throw new \RuntimeException("Middleware class '{$middlewareClass}' not found.");
                    }

                    (new $middlewareClass())->handle($carry);
                };
            },

            $final
        );

        $chain();
    }

    private static function callController(string $controller, string $action, array $params = []): void
    {
        try {
            if (!class_exists($controller)) {
                throw new \RuntimeException("Controller class '{$controller}' not found.");
            }

            $instance = new $controller();

            if (!method_exists($instance, $action)) {
                throw new \RuntimeException("Method '{$action}' not found in controller '{$controller}'.");
            }

            if ($instance instanceof Controller) {
                $instance->prepareRequest($action);
            }

            $response = $instance->$action(...array_values($params));
            echo $response;
            return;
        } catch (\Exception $e) {
            Logger::error($e->getMessage(), $e->getTrace());
            ErrorRoute::dispatch(500);
        }
    }
}
