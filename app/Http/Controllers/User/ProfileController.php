<?php

namespace App\Http\Controllers\User;

use App\Foundation\Http\Controller;
use App\Foundation\Support\Alert;
use App\Http\Request\PasswordRequest;
use App\Http\Request\ProfileRequest;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    protected array $requests = [
        'update' => ProfileRequest::class,
        'updatePassword' => PasswordRequest::class,
    ];

    private ProfileService $profileService;

    public function __construct()
    {
        $this->profileService = new ProfileService();
    }

    public function profile()
    {
        $data = $this->profileService->getProfileData();
        return view()::render('pages.user.profile', compact('data'));
    }

    public function update()
    {
        $data = $this->validated();
        $avatar = $_FILES['avatar'];

        $this->profileService->update($data, $avatar);
        Alert::success("Data profil anda berhasil diupdate.");
        return redirect('/profile');
    }

    public function updatePassword()
    {
        $data = $this->validated();
        $this->profileService->updatePassword($data['new_password']);
        Alert::success("Password anda berhasil diupdate.");
        return redirect('/profile');
    }
}