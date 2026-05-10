<?php

use App\Foundation\Support\Alert;
use App\Foundation\Support\Env;

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string
    {
        $baseUrl = rtrim(Env::get('APP_URL'), '/');
        $cleanPath = ltrim($path, '/');

        $cleanPath = preg_replace('/^public\/?/i', '', $cleanPath);

        if (!empty($cleanPath)) {
            return rtrim($baseUrl, '/') . '/' . $cleanPath;
        }

        return rtrim($baseUrl, '/');
    }
}

if (!function_exists('upload_url')) {
    function upload_url(string $type, string $fileName): string
    {
        return base_url("assets/uploads/{$type}/" . $fileName);
    }
}

if (!function_exists('dd')) {
    function dd(...$values): void
    {
        echo "<pre>";

        foreach ($values as $value) {
            print_r($value);
            echo "\n";
        }

        echo "</pre>";
        die;
        exit;
    }
}

if (!function_exists('uuid')) {
    function uuid(): string
    {
        $data = random_bytes(16);

        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}

if (!function_exists('generateComplaintCode')) {
    function generateComplaintCode(): string
    {
        $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3));
        $numbers = rand(1000, 9999);

        return "PDN-{$letters}-{$numbers}";
    }
}

if (!function_exists('getRandomId')) {
    function getRandomId($data)
    {
        return $data[array_rand($data)]['id'];
    }
}

if (!function_exists('redirect')) {
    function redirect(string $path = ''): void
    {
        $url = base_url($path);

        header("Location: {$url}");
        exit;
    }
}

if (!function_exists('back')) {
    function back(?string $alertMessage = null): void
    {
        if ($alertMessage) {
            Alert::error($alertMessage);
        }

        $url = $_SERVER['HTTP_REFERER'] ?? '/';

        header("Location: {$url}");
        exit;
    }
}

if (!function_exists('formatDate')) {
    function formatDate($datetime, $includeTime = true)
    {
        if (!$datetime) return '-';

        $pattern = $includeTime
            ? 'dd MMMM yyyy HH:mm:ss'
            : 'dd MMMM yyyy';

        $formatter = new IntlDateFormatter(
            'id_ID',
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            null,
            null,
            $pattern
        );

        return $formatter->format(new DateTime($datetime)) ?? '-';
    }
}

if (!function_exists('getInitials')) {
    function getInitials($name)
    {
        if (!$name) return "";

        $words = preg_split('/\s+/', trim($name));

        if (count($words) > 1) {
            return strtoupper(
                mb_substr($words[0], 0, 1) .
                    mb_substr($words[1], 0, 1)
            );
        }

        return strtoupper(mb_substr($words[0], 0, 2));
    }
}
