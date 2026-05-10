<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findAll()
    {
        $sql = "
            SELECT 
                id,
                username,
                email,
                phone,
                address,
                role,
                created_at
            FROM {table}
            WHERE role != 'admin' AND deleted_at IS NULL
            ORDER BY created_at DESC
        ";

        return User::query($sql)->fetchAll();
    }

    public function findByUsernameOrEmail(string $username, string $email)
    {
        return User::query("SELECT * FROM {table} WHERE username = ? OR email = ? AND deleted_at IS NULL")
            ->bind($username, $email)
            ->fetchOne();
    }

    public function findByUsernameOrEmailAndRole(string $username, string $email, string $role)
    {
        return User::query("SELECT * FROM {table} WHERE (username = ? OR email = ?) AND role = ? AND deleted_at IS NULL")
            ->bind($username, $email, $role)
            ->fetchOne();
    }

    public function findById(string $id)
    {
        return User::query("SELECT * FROM {table} WHERE id = ? AND deleted_at IS NULL")
            ->bind($id)
            ->fetchOne();
    }

    public function isUsernameOrEmailUniqueExceptId(string $username, string $email, string $id)
    {
        return User::query("SELECT * FROM {table} WHERE (username = ? OR email = ?) AND id <> ? AND deleted_at IS NULL")
            ->bind($username, $email, $id)
            ->fetchOne();
    }

    public function findByEmail(string $email)
    {
        return User::query("SELECT * FROM {table} WHERE email = ? AND deleted_at IS NULL")
            ->bind($email)
            ->fetchOne();
    }

    public function create(array $data)
    {
        return User::insert($data);
    }

    public function update(array $data, string $id)
    {
        return User::update($data, [
            'id' => $id,
        ]);
    }

    public function delete(string $id)
    {
        return User::update([
            'deleted_at' => date('Y-m-d H:i:s'),
        ], [
            'id' => $id,
        ]);
    }
}
