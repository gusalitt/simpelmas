<?php

namespace App\Http\Middlewares;

class CitizenMiddleware
{
    public function handle(callable $next)
    {
        $user = session()->get('user');
        
        if (!$user) {
            return redirect('/auth/login');
        }
        
        if ($user['role'] !== 'citizen') {
            if ($user['role'] === 'admin') {
                return redirect('/manage');
            }
            
            if ($user['role'] === 'worker') {
                return redirect('/manage');
            }
            
            return redirect('/auth/login');
        }
        
        return $next();
    }
}