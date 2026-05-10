<?php

namespace App\Http\Controllers\Manage;

use App\Foundation\Http\Controller;
use App\Foundation\Support\Alert;
use App\Http\Request\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected array $requests = [
        'store' => CategoryRequest::class,
        'update' => CategoryRequest::class,
    ];

    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return view()::render('pages.manage.category', compact('categories'));
    }

    public function store()
    {
        $data = $this->validated();
        $this->categoryService->create($data);

        Alert::success('Data kategori berhasil disimpan.');
        return redirect('/manage/category');
    }

    public function update()
    {
        $data = $this->validated();
        $id = $this->input('id');

        $this->categoryService->update($data, $id);
        Alert::success('Data kategori berhasil diupdate.');
        return redirect('/manage/category');
    }

    public function delete()
    {
        $id = $this->input('id');

        $this->categoryService->delete($id);
        Alert::success('Data kategori berhasil dihapus.');
        return redirect('/manage/category');
    }
}
