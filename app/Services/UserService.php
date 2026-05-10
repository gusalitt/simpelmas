<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function create(array $data)
    {
        $existingUser = $this->repository->findByUsernameOrEmail($data['username'], $data['email']);

        if ($existingUser) {
            return back("Pengguna dengan nama '{$data['username']}' atau email '{$data['email']}' sudah ada dalam sistem.");
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->repository->create($data);
    }

    public function update(array $data, string $id)
    {
        $uniqueUser = $this->repository->isUsernameOrEmailUniqueExceptId($data['username'], $data['email'], $id);
        if ($uniqueUser) {
            return back("Pengguna dengan nama '{$data['username']}' atau email '{$data['email']}' sudah ada dalam sistem.");
        }

        $existingUser = $this->repository->findById($id);
        if (!$existingUser) {
            return back("Pengguna tidak ditemukan. Silahkan coba lagi.");
        }

        return $this->repository->update($data, $id);
    }

    public function delete(string $id)
    {
        if (empty($id)) {
            return back("Pengguna tidak ditemukan. Silahkan coba lagi.");
        }

        $existingUser = $this->repository->findById($id);

        if (!$existingUser) {
            return back("Pengguna tidak ditemukan. Silahkan coba lagi.");
        }

        return $this->repository->delete($id);
    }
}