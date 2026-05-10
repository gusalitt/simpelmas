<?php

namespace App\Http\Controllers\User;

use App\Foundation\Http\Controller;
use App\Http\Request\ComplaintRequest;
use App\Services\ComplaintService;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected array $requests = [
        'storeComplaint' => ComplaintRequest::class
    ];

    private ComplaintService $complaintService;
    private DashboardService $dashboardService;

    public function __construct()
    {
        $this->complaintService = new ComplaintService();
        $this->dashboardService = new DashboardService();
    }

    public function index()
    {
        $data = $this->dashboardService->getUserDashboardData();
        return view()::render('pages.user.dashboard', compact('data'));
    }

    public function history()
    {
        $complaints = $this->complaintService->getComplaintsByUserId(auth()->id());
        return view()::render('pages.user.history', compact('complaints'));
    }
}
