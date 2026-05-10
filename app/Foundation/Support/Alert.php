<?php

namespace App\Foundation\Support;

class Alert
{
    protected const KEY = "alert";

    public static function set(string $type, string $message)
    {
        session()->setFlash(self::KEY, [
            'type' => $type,
            'message' => $message
        ]);
    }

    public static function get(): ?array
    {
        return session()->getFlash(self::KEY);
    }

    public static function render(): string
    {
        $alert = self::get();

        if (!empty($alert)) {
            return self::showAlert($alert['type'], $alert['message']);
        }

        return '';
    }

    public static function showAlert(string $type, string $message): string
    {
        $config = [
            'success' => [
                'bg' => 'bg-green-700',
                'text' => 'text-white',
                'border' => 'border-green-500',
                'icon' => '
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            '
            ],
            'error' => [
                'bg' => 'bg-red-700',
                'text' => 'text-white',
                'border' => 'border-red-500',
                'icon' => '
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86l-7.4 12.84A1 1 0 003.76 18h16.48a1 1 0 00.87-1.5l-7.4-12.84a1 1 0 00-1.74 0z">
                    </path>
                </svg>
            '
            ],
            'info' => [
                'bg' => 'bg-blue-700',
                'text' => 'text-white',
                'border' => 'border-blue-500',
                'icon' => '
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            '
            ]
        ];

        return <<<HTML
                <div class="fixed right-4 top-8 sm:right-8 z-50 space-y-2 max-w-sm">
                    <div id="alertDiv" class="flex items-start gap-3 px-4 py-3 rounded-2xl text-sm font-medium border shadow-lg transition-all duration-300 ease-in-out {$config[$type]['bg']} {$config[$type]['text']} {$config[$type]['border']}">
                        <div class="shrink-0 mt-0.5">
                            {$config[$type]['icon']}
                        </div>
                        <div class="flex-1 whitespace-normal wrap-break-word">
                            {$message}
                        </div>
                        <button onclick="this.closest('.flex').remove()" class="shrink-0 ml-2 transition-colors cursor-pointer"> 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path> 
                            </svg> 
                        </button>
                    </div>
                </div>
            HTML;
    }

    public static function success(string $message)
    {
        return self::set('success', $message);
    }

    public static function error(string $message)
    {
        return self::set('error', $message);
    }

    public static function info(string $message)
    {
        return self::set('info', $message);
    }
}
