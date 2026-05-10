<?php

namespace App\Http\Middlewares;

class StaffMiddleware
{
    public function handle(callable $next)
    {
        $user = session()->get('user');

        if (!$user) {
            return redirect('/auth/login');
        }

        if (!in_array($user['role'], ['admin', 'worker'])) {
            return redirect('/dashboard');
        }

        return $next();
    }
}
