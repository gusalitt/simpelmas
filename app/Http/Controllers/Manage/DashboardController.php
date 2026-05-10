<?php

namespace App\Http\Controllers\Manage;

use App\Foundation\Http\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    private DashboardService $dashboardService;

    public function __construct()
    {
        $this->dashboardService = new DashboardService();
    }

    public function index()
    {
        $data = $this->dashboardService->getStaffDashboardData();
        return view()::render('pages.manage.dashboard', compact('data'));
    }
}
