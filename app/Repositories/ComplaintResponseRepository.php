<?php

namespace App\Repositories;

use App\Models\ComplaintResponse;

class ComplaintResponseRepository
{
    public function create(array $data)
    {
        return ComplaintResponse::insert([
            'complaint_id' => $data['complaint_id'],
            'worker_id' => $data['worker_id'],
            'message' => $data['message'],
            'image_url' => $data['image_url'] ?? null,
        ]);
    }

    public function findByComplaintId($complaintId)
    {
        $sql = "
            SELECT
                rc.id,
                rc.worker_id,
                rc.message,
                rc.image_url,
                rc.created_at,
                u.username AS worker_name,
                u.avatar,
                u.role
            FROM {table} AS rc
            INNER JOIN users AS u ON rc.worker_id = u.id
            WHERE rc.complaint_id = ?
            ORDER BY rc.created_at ASC
        ";
        return ComplaintResponse::query($sql)
            ->bind($complaintId)
            ->fetchAll();
    }
}