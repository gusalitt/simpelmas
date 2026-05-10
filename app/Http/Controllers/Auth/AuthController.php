<?php

namespace App\Http\Controllers\Auth;

use App\Foundation\Http\Controller;
use App\Foundation\Support\Alert;
use App\Http\Request\LoginRequest;
use App\Http\Request\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected array $requests = [
        'login' => LoginRequest::class,
        'register' => RegisterRequest::class,
    ];

    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function showLoginForm()
    {
        return view()::render('pages.auth.login');
    }

    public function showRegisterForm()
    {
        return view()::render('pages.auth.register');
    }

    public function login()
    {
        $data = $this->validated();
        $user = $this->authService->attemptCredentials($data);

        $redirectMap = [
            'admin' => '/manage',
            'worker' => '/manage',
            'citizen' => '/dashboard',
        ];

        Alert::success("Login berhasil.");
        return redirect($redirectMap[$user['role']]);
    }

    public function register()
    {
        $data = $this->validated();
        $this->authService->register($data);
        Alert::success("Registrasi berhasil.");
        return redirect('/dashboard');
    }

    public function logout()
    {
        $this->authService->logout();
        Alert::success("Logout berhasil.");
        return redirect('/auth/login');
    }
}