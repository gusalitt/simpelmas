<?php

namespace App\Services;

use App\Repositories\UserRepository;

class AuthService
{
    protected static $user = null;

    public function setUser($user)
    {
        session()->set('user', $user);
        self::$user = $user;
    }

    public function putUser(array $data)
    {
        $currentUser = $this->user();

        if (!$currentUser) {
            return $this->setUser($data);
        }

        $updated = false;
        foreach ($data as $key => $value) {
            if (isset($currentUser[$key]) && $currentUser[$key] != $value) {
                $currentUser[$key] = $value;
                $updated = true;
            } elseif (!isset($currentUser[$key])) {
                $currentUser[$key] = $value;
                $updated = true;
            }
        }

        if ($updated) {
            $this->setUser($currentUser);
        }
    }

    public function user()
    {
        return self::$user ?? session()->get('user');
    }

    public function id()
    {
        return self::$user['id'] ?? session()->get('user')['id'] ?? null;
    }

    public function check()
    {
        return self::$user ?? session()->get('user') !== null;
    }

    public function attemptCredentials(array $credentials)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findByEmail($credentials['email']);

        if (empty($user)) {
            return back("Email atau password yang Anda masukkan salah.");
        }

        if (!password_verify($credentials['password'], $user['password'])) {
            return back("Email atau password yang Anda masukkan salah");
        }

        unset($user['password']);
        $this->setUser($user);

        $token = bin2hex(random_bytes(32));
        $ttl = time() + (7 * 24 * 60 * 60); // 7 days
        $payload = json_encode([
            'id' => $user['id'],
            'token' => $token,
            'expires_in' => $ttl
        ]);

        $encryptedPayload = $this->encrypt($payload);
        setcookie('remember_token', $encryptedPayload, $ttl, '/');

        return $user;
    }

    public function register(array $data)
    {
        $userRepository = new UserRepository();
        $existingUser = $userRepository->findByUsernameOrEmailAndRole($data['username'], $data['email'], 'citizen');

        if ($existingUser) {
            if ($existingUser['username'] === $data['username']) {
                return back("Username '{$data['username']}' sudah digunakan. Silakan pilih username lain.");
            }

            if ($existingUser['email'] === $data['email']) {
                return back("Email '{$data['email']}' sudah terdaftar. Silakan gunakan email lain.");
            }

            return back("Username atau email sudah terdaftar. Silakan gunakan yang lain.");
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $userId = $userRepository->create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'],
            'role' => 'citizen',
        ]);

        $user = $userRepository->findById($userId);

        unset($user['password']);
        unset($user['deleted_at']);
        $this->setUser($user);

        $token = bin2hex(random_bytes(32));
        $ttl = time() + (7 * 24 * 60 * 60); // 7 days
        $payload = json_encode([
            'id' => $user['id'],
            'token' => $token,
            'expires_in' => $ttl
        ]);

        $encryptedPayload = $this->encrypt($payload);
        setcookie('remember_token', $encryptedPayload, $ttl, '/');

        return $user;
    }

    public function logout()
    {
        session()->remove('user');
        session_destroy();
        unset($_SESSION);
        $this->clearRememberCookie();
        self::$user = null;
    }

    private function encrypt(mixed $data)
    {
        $key = env('ENCRYPTION_KEY');
        $iv = random_bytes(16);

        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    public function decrypt(mixed $data)
    {
        $key = env('ENCRYPTION_KEY');

        $decoded = base64_decode($data);
        $iv = substr($decoded, 0, 16);
        $encrypted = substr($decoded, 16);

        return openssl_decrypt($encrypted, 'AES-256-CBC', $key, 0, $iv);
    }

    public function clearRememberCookie()
    {
        $ttl = time() - (7 * 24 * 60 * 60); // 7 days
        setcookie('remember_token', '', $ttl, '/');
    }
}
