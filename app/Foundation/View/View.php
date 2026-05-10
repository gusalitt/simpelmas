<?php

namespace App\Foundation\View;

use Exception;

class View
{
    protected static string $layout;
    protected static array $layoutStack = [];
    protected static array $sections = [];
    protected static array $sectionStack = [];

    public static function render(string $view, array $data = [])
    {
        self::reset();
        extract($data);

        ob_start();
        require self::path($view);
        while ($layout = array_pop(self::$layoutStack)) {
            require self::path($layout);
        }

        return ob_get_clean();
    }

    public static function extend(string $layout): void
    {
        self::$layoutStack[] = $layout;
    }

    public static function push(string $key)
    {
        self::$sectionStack[] = $key;
        ob_start();
    }

    public static function endPush(string $key)
    {
        if (empty(self::$sectionStack)) {
            throw new Exception("endPush('{$key}') called without section()");
        }

        $lastKey = array_pop(self::$sectionStack);

        if ($lastKey !== $key) {
            throw new Exception(
                "Section mismatch: endPush('{$key}') but last section is '{$lastKey}'"
            );
        }

        self::$sections[$key] = ob_get_clean();
    }

    public static function stack(string $key)
    {
        echo self::$sections[$key] ?? '';
    }

    public static function include(string $view, ?array $data = null)
    {
        extract($data ?? []);
        require self::path($view);
    }

    protected static function path(string $view): string
    {
        return __DIR__ . '/../../Views/' . str_replace('.', '/', $view) . '.php';
    }

    protected static function reset()
    {
        self::$layoutStack = [];
        self::$sections = [];
        self::$sectionStack = [];
    }
}
