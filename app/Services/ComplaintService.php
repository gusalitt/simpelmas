<?php

namespace App\Services;

use App\Foundation\Database\DB;
use App\Foundation\Support\Alert;
use App\Repositories\CategoryRepository;
use App\Repositories\ComplaintResponseRepository;
use App\Repositories\ComplaintRepository;

class ComplaintService
{
    private ComplaintRepository $repository;
    private CategoryRepository $categoryRepository;
    private ComplaintResponseRepository $complaintResponseRepository;

    public function __construct()
    {
        $this->repository = new ComplaintRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->complaintResponseRepository = new ComplaintResponseRepository();
    }

    public function getNewComplaints()
    {
        return [
            'complaints' => $this->repository->findNewComplaints(),
            'categories' => $this->categoryRepository->findListCategories(),
        ];
    }

    public function takeComplaint(string $id, string $takenBy, string $note)
    {
        return DB::transaction(function () use ($id, $takenBy, $note) {

            if (!empty($note)) {
                $this->complaintResponseRepository->create([
                    'complaint_id' => $id,
                    'worker_id' => $takenBy,
                    'message' => $note
                ]);
            }

            return $this->repository->updateTakenBy($id, $takenBy);
        });
    }

    public function getProcessingComplaints()
    {
        return [
            'complaints' => $this->repository->findProcessingComplaints(),
            'categories' => $this->categoryRepository->findListCategories(),
        ];
    }

    public function getProcessingComplaintDetail(string $id)
    {
        $existingComplaint = $this->repository->findByIdAndStatus($id, 'processed');
        if (!$existingComplaint) {
            Alert::error("Pengaduan tidak ditemukan. Silahkan coba lagi.");
            return redirect('/manage/complaint/processing');
        }

        $complaints = $this->repository->findProcessingComplaintDetail($id);
        $responses = $this->complaintResponseRepository->findByComplaintId($id);
        return [
            'complaint' => $complaints,
            'responses' => $responses,
            'response_count' => count($responses),
        ];
    }

    public function getCompletedComplaintDetail(string $id)
    {
        $existingComplaint = $this->repository->findByIdAndStatus($id, 'done');
        if (!$existingComplaint) {
            Alert::error("Pengaduan tidak ditemukan. Silahkan coba lagi.");
            return redirect('/manage/complaint/completed');
        }

        $complaints = $this->repository->findCompletedComplaintDetail($id);
        $responses = $this->complaintResponseRepository->findByComplaintId($id);
        return [
            'complaint' => $complaints,
            'responses' => $responses,
            'response_count' => count($responses),
        ];
    }

    public function responseComplaint(string $id, string $message, ?array $image = null)
    {
        $existingComplaint = $this->repository->findByIdAndStatus($id, 'processed');

        if (!$existingComplaint) {
            Alert::error("Pengaduan tidak ditemukan. Silahkan coba lagi.");
            return redirect('/manage/complaint/processing');
        }

        if (!empty($image) && $image['error'] !== UPLOAD_ERR_NO_FILE) {
            $fileName = ImageUploadService::upload('responses/', 'image');

            if (empty($fileName)) {
                return back("Gagal mengupload gambar. Silahkan coba lagi.");
            }
        }

        return $this->complaintResponseRepository->create([
            'complaint_id' => $id,
            'worker_id' => auth()->id(),
            'message' => $message,
            'image_url' => $fileName ?? null
        ]);
    }

    public function completeComplaint(string $id)
    {
        if (empty($id)) {
            return back("Pengaduan tidak ditemukan. Silahkan coba lagi.");
        }

        $existingComplaint = $this->repository->findByIdAndStatus($id, 'processed');
        if (!$existingComplaint) {
            return back("Pengaduan tidak ditemukan. Silahkan coba lagi.");
        }

        return $this->repository->updateStatus($id, 'done');
    }

    public function getCompletedComplaints()
    {
        return [
            'complaints' => $this->repository->findCompletedComplaints(),
            'categories' => $this->categoryRepository->findListCategories(),
        ];
    }

    public function getComplaintsByUserId(string $userId)
    {
        return $this->repository->findComplaintByUserId($userId);
    }

    public function getComplaintDetailById(string $id)
    {
        $existingComplaint = $this->repository->findById($id);
        if (!$existingComplaint) {
            Alert::error("Pengaduan tidak ditemukan. Silahkan coba lagi.");
            return redirect('/history');
        }

        $complaints = $this->repository->findComplaintDetailById($id);
        $responses = $this->complaintResponseRepository->findByComplaintId($id);
        return [
            'complaint' => $complaints,
            'responses' => $responses,
            'response_count' => count($responses),
        ];
    }

    public function createComplaint(array $data, ?array $image = null)
    {
        $existingCategory = $this->categoryRepository->findById($data['category']);

        if (!$existingCategory) {
            return back("Kategori tidak ditemukan. Silahkan coba lagi.");
        }

        if (!empty($image) && $image['error'] !== UPLOAD_ERR_NO_FILE) {
            $fileName = ImageUploadService::upload('complaints/', 'image');

            if (empty($fileName)) {
                return back("Gagal mengupload gambar. Silahkan coba lagi.");
            }
        }

        $dataToCreate = [
            'complaint_code' => generateComplaintCode(),
            'category_id' => $existingCategory['id'],
            'title' => $data['title'],
            'location' => $data['location'],
            'content' => $data['description'],
            'image_url' => $fileName ?? null,
            'user_id' => auth()->id(),
            'status' => 'new',
        ];  
        return $this->repository->create($dataToCreate);
    }
}
