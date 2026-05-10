<?php

namespace App\Http\Controllers\User;

use App\Foundation\Http\Controller;
use App\Foundation\Support\Alert;
use App\Http\Request\ComplaintRequest;
use App\Services\CategoryService;
use App\Services\ComplaintService;

class ComplaintController extends Controller
{
    protected array $requests = [
        'storeComplaint' => ComplaintRequest::class
    ];

    private ComplaintService $complaintService;
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->complaintService = new ComplaintService();
        $this->categoryService = new CategoryService();
    }

    public function createComplaint()
    {
        $data = $this->categoryService->getListCategories();
        return view()::render('pages.user.create_complaint', compact('data'));
    }

    public function storeComplaint()
    {
        $data = $this->validated();
        $image = $_FILES['image'];

        $this->complaintService->createComplaint($data, $image);
        Alert::success("Pengaduan berhasil dibuat.");
        return redirect('/history');
    }

    public function complaintDetail(string $id)
    {
        $data = $this->complaintService->getComplaintDetailById($id);
        return view()::render('pages.user.complaint_detail', compact('data'));
    }
}
