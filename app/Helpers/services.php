<?php

use App\Foundation\Support\Alert;
use App\Foundation\Support\Env;
use App\Foundation\Support\Session;
use App\Foundation\View\View;
use App\Services\AuthService;

if (!function_exists('view')) {
    function view(): string
    {
        return View::class;
    }
}

if (!function_exists('session')) {
    function session(): Session
    {
        static $instance;

        if (!$instance) {
            $instance = new Session();
        }

        return $instance;
    }
}

if (!function_exists('error')) {
    function error(string $key): ?string
    {
        $finalKey = "errors.{$key}";
        return session()->getFlash($finalKey);
    }
}

if (!function_exists('old')) {
    function old(string $key): ?string
    {
        $finalKey = "old.{$key}";
        return session()->getFlash($finalKey);
    }
}

if (!function_exists('env')) {
    function env(string $key, string $default = ''): ?string
    {
        return Env::get($key, $default);
    }
}

if (!function_exists('alert')) {
    function alert(): string
    {
        return Alert::render();
    }
}

if (!function_exists('auth')) {
    function auth(): AuthService
    {
        static $instance;

        if (!$instance) {
            $instance = new AuthService();
        }

        return $instance;
    }
}
