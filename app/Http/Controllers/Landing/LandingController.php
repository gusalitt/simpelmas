<?php

namespace App\Http\Controllers\Landing;

use App\Foundation\Http\Controller;
use App\Repositories\ComplaintRepository;

class LandingController extends Controller
{
    public function index()
    {
        $complaintRepository = new ComplaintRepository();
        $stats = $complaintRepository->findComplaintStats();
        return view()::render('pages.landing.index', compact('stats'));
    }

    public function about()
    {
        return view()::render('pages.landing.about');
    }
}
