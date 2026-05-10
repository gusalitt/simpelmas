<?php

namespace App\Http\Controllers\Manage;

use App\Foundation\Http\Controller;
use App\Foundation\Support\Alert;
use App\Http\Request\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    protected array $requests = [
        'store' => UserRequest::class,
        'update' => UserRequest::class,
    ];

    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        $users = $this->userService->getAll();
        return view()::render('pages.manage.user', compact('users'));
    }

    public function store()
    {
        $data = $this->validated();
        $this->userService->create($data);

        Alert::success('Data pengguna berhasil disimpan.');
        return redirect('/manage/user');
    }

    public function update()
    {
        $data = $this->validated();
        $id = $this->input('id');

        $this->userService->update($data, $id);
        Alert::success('Data pengguna berhasil diupdate.');
        return redirect('/manage/user');
    }

    public function delete()
    {
        $id = $this->input('id');

        $this->userService->delete($id);
        Alert::success('Data pengguna berhasil dihapus.');
        return redirect('/manage/user');
    }
}
