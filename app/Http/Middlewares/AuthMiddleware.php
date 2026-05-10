<?php

namespace App\Http\Middlewares;

use App\Repositories\UserRepository;

class AuthMiddleware
{
    public function handle(callable $next)
    {
        $session = session()->get('user');

        if ($session) {
            return $next();
        }

        $cookie = $_COOKIE['remember_token'] ?? null;

        if (!$cookie) {
            return redirect('/auth/login');
        }

        try {
            $payload = auth()->decrypt($cookie);
            $userData = json_decode($payload, true);

            if (!$userData || !isset($userData['id']) || !isset($userData['token']) || !isset($userData['expires_in'])) {
                auth()->clearRememberCookie();
                return redirect('/auth/login');
            }

            if ($userData['expires_in'] < time()) {
                auth()->clearRememberCookie();
                return redirect('/auth/login');
            }

            $user = (new UserRepository())->findById($userData['id']);

            if (empty($user)) {
                auth()->clearRememberCookie();
                return redirect('/auth/login');
            }

            unset($user['password']);
            unset($user['deleted_at']);
            auth()->setUser($user);
            return $next();
        } catch (\Exception $e) {
            auth()->clearRememberCookie();
            return redirect('/auth/login');
        }
    }
}
