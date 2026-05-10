<?php

namespace App\Http\Controllers\Manage;

use App\Foundation\Http\Controller;
use App\Foundation\Support\Alert;
use App\Http\Request\ResponseRequest;
use App\Http\Request\TakeComplaintRequest;
use App\Services\ComplaintService;

class ComplaintController extends Controller
{
    private ComplaintService $complaintService;
    protected array $requests = [
        'takeComplaint' => TakeComplaintRequest::class,
        'responseComplaint' => ResponseRequest::class,
    ];

    public function __construct()
    {
        $this->complaintService = new ComplaintService();
    }

    public function newComplaint()
    {
        $data = $this->complaintService->getNewComplaints();
        return view()::render('pages.manage.complaints.new', compact('data'));
    }

    public function takeComplaint()
    {
        $data = $this->validated();
        $takenBy = auth()->id();

        $this->complaintService->takeComplaint($data['id'], $takenBy, $data['note']);
        Alert::success("Pengaduan berhasil diambil & diproses.");
        return redirect('/manage/complaint/processing');
    }

    public function processingComplaint()
    {
        $data = $this->complaintService->getProcessingComplaints();
        return view()::render('pages.manage.complaints.processing', compact('data'));
    }

    public function processingComplaintDetail($id)
    {
        $data = $this->complaintService->getProcessingComplaintDetail($id);
        return view()::render('pages.manage.complaints.processing_detail', compact('data'));
    }

    public function responseComplaint()
    {
        $data = $this->validated();
        $image = $_FILES['image'];

        $this->complaintService->responseComplaint($data['id'], $data['message'], $image);

        Alert::success("Pengaduan berhasil ditanggapi.");
        return redirect('/manage/complaint/processing/detail/' . $data['id']);
    }

    public function completeComplaint()
    {
        $id = $this->input('id');

        $this->complaintService->completeComplaint($id);
        Alert::success("Pengaduan berhasil diselesaikan.");
        return redirect('/manage/complaint/completed');
    }

    public function completedComplaint()
    {
        $data = $this->complaintService->getCompletedComplaints();
        return view()::render('pages.manage.complaints.completed', compact('data'));
    }

    public function completedComplaintDetail($id)
    {
        $data = $this->complaintService->getCompletedComplaintDetail($id);
        return view()::render('pages.manage.complaints.completed_detail', compact('data'));
    }

    public function printComplaint()
    {
        return view()::render('pages.manage.print_complaint copy');
    }

    public function printComplaintPreview()
    {
        
    }
}
