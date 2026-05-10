<?php

namespace App\Foundation\Support;

class Logger
{
    protected static string $basePath;
    protected static array $channels = [
        'app' => [
            'file' => 'app',
            'folder' => 'app',
        ],
        'error' => [
            'file' => 'error',
            'folder' => 'errors',
        ],
        'query' => [
            'file' => 'query',
            'folder' => 'queries',
        ],
    ];

    protected static function init(): void
    {
        if (!isset(self::$basePath)) {
            self::$basePath = __DIR__ . '/../../../storage/logs/';
        }

        if (!is_dir(self::$basePath)) {
            mkdir(self::$basePath, 0777, true);
        }

        foreach (self::$channels as $channel) {
            if (!is_dir(self::$basePath . $channel['folder'])) {
                mkdir(self::$basePath . $channel['folder'], 0777, true);
            }
        }
    }

    protected static function resolveChannel(string $channel): array
    {
        if (!isset(self::$channels[$channel])) {
            $channel = 'app';
        }

        return [
            'file' => self::$channels[$channel]['file'],
            'title' => strtoupper($channel)
        ];
    }

    protected static function format(string $title, string $level, string $message, array $context = []): string
    {
        $time = date('Y-m-d H:i:s');
        $contextString = !empty($context) ? json_encode($context, JSON_UNESCAPED_SLASHES) : '';

        $log = "[{$time}] {$title}.{$level}: {$message}\n";

        if ($contextString) {
            $log .= "Context: {$contextString}\n";
        }

        return $log;
    }

    protected static function write(string $channel, string $level, string $message, array $context = []): void
    {
        self::init();

        $resolved = self::resolveChannel($channel);
        $date = date('Y-m-d');
        $filePath = self::$basePath . self::$channels[$channel]['folder'] . '/' . "{$resolved['file']}-{$date}.log";

        $formatted = self::format(
            $resolved['title'],
            strtoupper($level),
            $message,
            $context
        );

        file_put_contents($filePath, $formatted, FILE_APPEND);
    }

    public static function log(string $channel, string $level, string $message, array $context = []): void
    {
        self::write($channel, $level, $message, $context);
    }

    public static function info(string $message, array $context = []): void
    {
        self::write('app', 'INFO', $message, $context);
    }

    public static function error(string $message, array $context = []): void
    {
        self::write('error', 'ERROR', $message, $context);
    }

    public static function query(string $sql, array $bindings = [], ?float $time = null): void
    {
        $context = [
            'bindings' => $bindings,
        ];

        if ($time != null) {
            $context['time_ms'] = $time;
        }

        self::write('query', 'QUERY', $sql, $context);
    }

    public static function exception(\Throwable $e): void
    {
        self::write('error', 'EXCEPTION', $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
    }
}