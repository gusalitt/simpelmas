<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ImageUploadService;

class ProfileService
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function getProfileData()
    {
        $id = auth()->id();
        $data = $this->repository->findById($id);

        if (empty($data)) {
            return back('Gagal mengambil data profil.');
        }

        $hiddenFields = ['id', 'password', 'deleted_at', 'role'];
        return array_filter($data, fn($key) => !in_array($key, $hiddenFields), ARRAY_FILTER_USE_KEY);
    }

    public function update(array $data, ?array $avatar = null)
    {
        $existingUser = $this->repository->findById(auth()->id());

        if (empty($existingUser)) {
            return back('Gagal mengupdate profil.');
        }

        $fileName = $existingUser['avatar'] ?? null;

        if (!empty($avatar) && $avatar['error'] !== UPLOAD_ERR_NO_FILE) {
            $fileName = ImageUploadService::update('avatars/', 'avatar', $existingUser['avatar']);

            if (empty($fileName)) {
                return back("Gagal mengupdate foto avatar. Silahkan coba lagi.");
            }
        }

        $id = auth()->id();

        $dataToUpdate = [
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'avatar' => $fileName ?? null,
        ];

        $isSuccess = $this->repository->update($dataToUpdate, $id);
        auth()->putUser($dataToUpdate);

        return $isSuccess;
    }

    public function updatePassword(string $newPassword)
    {
        $existingUser = $this->repository->findById(auth()->id());

        if (empty($existingUser)) {
            return back('Gagal mengupdate password.');
        }

        if (password_verify($newPassword, $existingUser['password'])) {
            return back('Password lama tidak boleh sama dengan password baru.');
        }

        $id = auth()->id();

        return $this->repository->update([
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ], $id);
    }
}
