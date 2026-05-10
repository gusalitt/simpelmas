<?php

namespace App\Foundation;

use App\Foundation\Routing\Route;
use App\Foundation\Routing\Router;
use App\Foundation\Support\Env;

class Application
{
    protected string $basePath;
    private array $configRegistry = [];
    private array $middlewareRegistry = [];
    private ?string $webRoutesPath = null;
    private array $helpers = [];

    private function __construct() {}

    public static function configure(string $basePath): static
    {
        $app = new static();
        $app->basePath = rtrim($basePath, '/');

        $app->registerAutoload();

        // Load environment variables from .env file
        Env::load($app->basePath . '/.env');

        return $app;
    }

    protected function registerAutoload(): void
    {
        spl_autoload_register(function ($class) {
            $prefix = 'App\\';

            $length = strlen($prefix);
            if (strncmp($prefix, $class, $length) !== 0) {
                return;
            }

            $class = str_replace('App\\', 'app\\', $class);
            $file = $this->basePath . '/' . str_replace('\\', '/', $class) . '.php';

            if (file_exists($file)) {
                require_once $file;
            }
        });
    }

    public function withConfigs(array $configs): static
    {
        $this->configRegistry = $configs;
        return $this;
    }

    public function withRouting(string $web): static
    {
        $this->webRoutesPath = $web;
        return $this;
    }

    public function withMiddleware(array $middleware): static
    {
        $this->middlewareRegistry = $middleware;
        return $this;
    }

    public function withHelpers(array $helpers): static
    {
        $this->helpers = $helpers;
        return $this;
    }

    public function run(): void
    {
        $this->loadHelpers($this->helpers);
        $this->loadConfigs($this->configRegistry);

        Route::setMiddlewareRegistry($this->middlewareRegistry);

        $this->loadRoutes($this->webRoutesPath);
        Router::dispatch();
    }

    private function loadConfigs(array $configs): void
    {
        foreach ($configs as $path => $resolver) {
            $fullpath = $this->basePath . '/' . $path;

            if (!is_file($fullpath)) {
                throw new \RuntimeException("Config file not found: {$fullpath}");
            }

            $config = require_once $fullpath;

            $resolvers = is_array($resolver) ? $resolver : [$resolver];

            foreach ($resolvers as $resolver) {
                if (is_callable($resolver)) {
                    $resolver($config);
                }
            }
        }
    }

    private function loadRoutes(string $routesPath): void
    {
        $path = $this->basePath . '/' . $routesPath;

        if (!file_exists($path)) {
            throw new \RuntimeException("Routes file not found: {$path}");
        }

        require_once $path;
    }

    private function loadHelpers(array $helpers): void
    {
        foreach ($helpers as $helper) {
            $path = $this->basePath . '/' . $helper;

            if (!file_exists($path)) {
                throw new \RuntimeException("Helper file not found: {$path}");
            }

            require_once $path;
        }
    }
}
