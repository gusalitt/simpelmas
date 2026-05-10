<?php

use App\Foundation\Database\DB;

$dummyUsers = [
    // Admin
    ['username' => 'Admin', 'email' => 'admin@example.com', 'phone' => '081234567890', 'address' => 'Jl. Sudirman No. 10, Jakarta', 'role' => 'admin', 'avatar' => null],

    // Workers
    ['username' => 'Budi Santoso', 'email' => 'budi@example.com', 'phone' => '081234567891', 'address' => 'Jl. Pendidikan No. 1', 'role' => 'worker', 'avatar' => null],
    ['username' => 'Ani Wulandari', 'email' => 'ani@example.com', 'phone' => '081234567892', 'address' => 'Jl. Kemakmuran No. 1', 'role' => 'worker', 'avatar' => null],
    ['username' => 'Doni Ramadhan', 'email' => 'doni@example.com', 'phone' => '081234567893', 'address' => 'Jl. Pahlawan No. 1', 'role' => 'worker', 'avatar' => null],
    ['username' => 'Siti Aminah', 'email' => 'siti@example.com', 'phone' => '081234567894', 'address' => 'Jl. Kartini No. 1', 'role' => 'worker', 'avatar' => null],
    ['username' => 'Eko Prasetyo', 'email' => 'eko@example.com', 'phone' => '081234567895', 'address' => 'Jl. Gatot Subroto No. 1', 'role' => 'worker', 'avatar' => null],

    // Citizens
    ['username' => 'Ahmad Rizki', 'email' => 'ahmad@example.com', 'phone' => '081234567901', 'address' => 'Jl. Raya No. 2', 'role' => 'citizen', 'avatar' => null],
    ['username' => 'Siti Nurhaliza', 'email' => 'siti_nur@example.com', 'phone' => '081234567902', 'address' => 'Jl. Pendidikan No. 2', 'role' => 'citizen', 'avatar' => null],
    ['username' => 'Agus Saputra', 'email' => 'agus@example.com', 'phone' => '081234567903', 'address' => 'Jl. Kemakmuran No. 2', 'role' => 'citizen', 'avatar' => null],
    ['username' => 'Dewi Kartika', 'email' => 'dewi@example.com', 'phone' => '081234567904', 'address' => 'Jl. Pahlawan No. 2', 'role' => 'citizen', 'avatar' => null],
    ['username' => 'Hendra Gunawan', 'email' => 'hendra@example.com', 'phone' => '081234567905', 'address' => 'Jl. Kartini No. 2', 'role' => 'citizen', 'avatar' => null],
    ['username' => 'Rina Amelia', 'email' => 'rina@example.com', 'phone' => '081234567906', 'address' => 'Jl. Gatot Subroto No. 2', 'role' => 'citizen', 'avatar' => null],
    ['username' => 'Bayu Adjie', 'email' => 'bayu@example.com', 'phone' => '081234567907', 'address' => 'Jl. Raya No. 3', 'role' => 'citizen', 'avatar' => null],
    ['username' => 'Maya Sari', 'email' => 'maya@example.com', 'phone' => '081234567908', 'address' => 'Jl. Pendidikan No. 3', 'role' => 'citizen', 'avatar' => null],
    ['username' => 'Rizki Fadillah', 'email' => 'rizki@example.com', 'phone' => '081234567909', 'address' => 'Jl. Kemakmuran No. 3', 'role' => 'citizen', 'avatar' => null],
    ['username' => 'Lisa Febrianti', 'email' => 'lisa@example.com', 'phone' => '081234567910', 'address' => 'Jl. Pahlawan No. 3', 'role' => 'citizen', 'avatar' => null],
];

$hashedPassword = password_hash('password123', PASSWORD_DEFAULT);

return [
    'run' => function (array &$context) use ($dummyUsers, $hashedPassword) {
        $context['users'] = [];

        foreach ($dummyUsers as $user) {
            $id = uuid();

            DB::query("INSERT INTO users (id, username, email, password, avatar, phone, address, role, deleted_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NULL)")
                ->bind(
                    $id,
                    $user['username'],
                    $user['email'],
                    $hashedPassword,
                    $user['avatar'],
                    $user['phone'],
                    $user['address'],
                    $user['role'],
                )
                ->execute();

            $context['users'][] = array_merge($user, ['id' => $id]);
        }
    }
];
