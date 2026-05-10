<?php

namespace App\Http\Middlewares;

class GuestMiddleware
{
    public function handle(callable $next)
    {
        $user = session()->get('user');

        $roleMappingRedirect = [
            'admin' => '/manage',
            'worker' => '/manage',
            'citizen' => '/dashboard',
        ];

        if ($user) {
            return redirect($roleMappingRedirect[$user['role']] ?? '/');
        }

        return $next();
    }
}