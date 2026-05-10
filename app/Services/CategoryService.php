<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private CategoryRepository $repository;

    public function __construct()
    {
        $this->repository = new CategoryRepository();
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function create(array $data)
    {
        $existingCategory = $this->repository->findByName($data['name']);

        if ($existingCategory) {
            return back("Kategori dengan nama '{$data['name']}' sudah ada. Silakan gunakan nama yang lain.");
        }

        return $this->repository->create($data);
    }

    public function update(array $data, string $id)
    {
        $uniqueCategory = $this->repository->isNameUniqueExceptId($data['name'], $id);
        if ($uniqueCategory) {
            return back("Kategori dengan nama '{$data['name']}' sudah ada. Silakan gunakan nama yang lain.");
        }

        $existingCategory = $this->repository->findById($id);
        if (!$existingCategory) {
            return back("Kategori tidak ditemukan. Silahkan coba lagi.");
        }

        return $this->repository->update($data, $id);
    }

    public function delete(string $id)
    {
        if (empty($id)) {
            return back("Kategori tidak ditemukan. Silahkan coba lagi.");
        }

        $existingCategory = $this->repository->findById($id);

        if (!$existingCategory) {
            return back("Kategori tidak ditemukan. Silahkan coba lagi.");
        }

        return $this->repository->delete($id);
    }

    public function getListCategories()
    {
        return $this->repository->findListCategories();
    }
}