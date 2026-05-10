<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function findAll()
    {
        $sql = "
            SELECT 
                c.id,
                c.name,
                c.description,
                c.created_at,
                COUNT(cp.id) AS complaint_count
            FROM {table} AS c
            LEFT JOIN complaints AS cp ON c.id = cp.category_id
            WHERE c.deleted_at IS NULL
            GROUP BY c.id, c.name, c.description, c.created_at
            ORDER BY c.created_at DESC
        ";

        return Category::query($sql)->fetchAll();
    }

    public function findListCategories()
    {
        return Category::query("SELECT id, name FROM {table} WHERE deleted_at IS NULL")->fetchAll();
    }

    public function findByName(string $name)
    {
        return Category::query("SELECT * FROM {table} WHERE name = ? AND deleted_at IS NULL")
            ->bind($name)
            ->fetchOne();
    }

    public function findById(string $id)
    {
        return Category::query("SELECT * FROM {table} WHERE id = ? AND deleted_at IS NULL")
            ->bind($id)
            ->fetchOne();
    }

    public function isNameUniqueExceptId(string $name, string $id)
    {
        return Category::query("SELECT * FROM {table} WHERE name = ? AND id <> ? AND deleted_at IS NULL")
            ->bind($name, $id)
            ->fetchOne();
    }

    public function create(array $data)
    {
        return Category::insert($data);
    }

    public function update(array $data, string $id)
    {
        return Category::update([
            'name' => $data['name'],
            'description' => $data['description'],
        ], [
            'id' => $id,
        ]);
    }

    public function delete(string $id)
    {
        return Category::update([
            'deleted_at' => date('Y-m-d H:i:s'),
        ], [
            'id' => $id,
        ]);
    }

    public function findCategoryStats()
    {
        $sqlStats = "
            SELECT 
                c.name,
                COUNT(cp.id) AS complaint_count
            FROM categories AS c
            LEFT JOIN complaints AS cp ON c.id = cp.category_id
            WHERE c.deleted_at IS NULL
            GROUP BY c.id, c.name
            ORDER BY c.created_at DESC
        ";

        return Category::query($sqlStats)->fetchAll();
    }
}
