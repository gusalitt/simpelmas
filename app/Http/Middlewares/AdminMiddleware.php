<?php

namespace App\Http\Middlewares;

class AdminMiddleware
{
    public function handle(callable $next)
    {
        $user = session()->get('user');
        
        if (!$user) {
            return redirect('/auth/login');
        }
        
        if ($user['role'] !== 'admin') {
            if ($user['role'] === 'worker') {
                return redirect('/manage');
            }
            
            if ($user['role'] === 'citizen') {
                return redirect('/dashboard');
            }
            
            return redirect('/auth/login');
        }
        
        return $next();
    }
}