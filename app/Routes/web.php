<?php

use App\Foundation\Routing\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Manage\DashboardController;
use App\Http\Controllers\Manage\UserController;
use App\Http\Controllers\Manage\CategoryController;
use App\Http\Controllers\Manage\ComplaintController;
use App\Http\Controllers\Manage\PrintController;
use App\Http\Controllers\Manage\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ComplaintController as UserComplaintController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

Route::prefix('/Project/Experimental/Fullstack/Simpelmas')->group(function () {
    Route::get('/', [LandingController::class, 'index']);
    Route::get('/about', [LandingController::class, 'about']);

    Route::prefix('/auth')
        ->middleware('role.guest')
        ->controller(AuthController::class)
        ->group(function () {
            Route::get('/login', 'showLoginForm');
            Route::get('/register', 'showRegisterForm');
            Route::post('/login', 'login');
            Route::post('/register', 'register');
        });

    Route::middleware('auth')->post('/auth/logout', [AuthController::class, 'logout']);

    Route::middleware(['auth', 'role.citizen'])
        ->group(function () {
            Route::get('/dashboard', [UserDashboardController::class, 'index']);
            Route::get('/history', [UserDashboardController::class, 'history']);

            Route::prefix('/complaint')
                ->controller(UserComplaintController::class)
                ->group(function () {
                    Route::get('/create', 'createComplaint');
                    Route::post('/create', 'storeComplaint');
                    Route::get('/detail/{id}', 'complaintDetail');
                });

            Route::prefix('/profile')
                ->controller(UserProfileController::class)
                ->group(function () {
                    Route::get('/', 'profile');
                    Route::post('/', 'update');
                    Route::post('/update-password', 'updatePassword');
                });
        });

    Route::prefix('/manage')
        ->middleware('auth')
        ->group(function () {
            Route::middleware('role.staff')->get('/', [DashboardController::class, 'index']);

            Route::prefix('/user')
                ->middleware('role.admin')
                ->controller(UserController::class)
                ->group(function () {
                    Route::get('/', 'index');
                    Route::post('/create', 'store');
                    Route::post('/update', 'update');
                    Route::post('/delete', 'delete');
                });

            Route::prefix('/category')
                ->middleware('role.staff')
                ->controller(CategoryController::class)
                ->group(function () {
                    Route::get('/', 'index');
                    Route::post('/create', 'store');
                    Route::post('/update', 'update');
                    Route::post('/delete', 'delete');
                });

            Route::prefix('/complaint')
                ->middleware('role.staff')
                ->controller(ComplaintController::class)
                ->group(function () {
                    Route::get('/new', 'newComplaint');
                    Route::post('/take', 'takeComplaint');

                    Route::get('/processing', 'processingComplaint');
                    Route::get('/processing/detail/{id}', 'processingComplaintDetail');
                    Route::post('/response', 'responseComplaint');
                    Route::post('/complete', 'completeComplaint');

                    Route::get('/completed', 'completedComplaint');
                    Route::get('/completed/detail/{id}', 'completedComplaintDetail');

                    Route::get('/print', 'printComplaint');
                    Route::get('/print/preview', 'printComplaintPreview');
                });

            Route::prefix('/print')
                ->middleware('role.staff')
                ->controller(PrintController::class)
                ->group(function () {
                    Route::get('/complaint/preview', 'printComplaintPreview');
                    Route::post('/complaint', 'printComplaint');
                });

            Route::prefix('/profile')
                ->middleware('role.staff')
                ->controller(ProfileController::class)
                ->group(function () {
                    Route::get('/', 'profile');
                    Route::post('/', 'update');
                    Route::post('/update-password', 'updatePassword');
                });
        });
});

Route::error(ErrorController::class)
    ->when(404, 'notFound')
    ->otherwise('internalServerError');