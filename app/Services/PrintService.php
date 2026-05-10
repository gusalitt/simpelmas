<?php

namespace App\Services;

use App\Foundation\Database\DB;

class PrintService
{
    public function printComplaint(array $data) 
    {
        if ($data['print_option'] === 'complaint-only') {
            return $this->getComplaintsOnly($data['start_date'], $data['end_date'], $data['status']);
        }

        if ($data['print_option'] === 'full') {
            return $this->getComplaintsWithResponses($data['start_date'], $data['end_date'], $data['status']);
        }
    }

    private function getComplaintsOnly($startDate = null, $endDate = null, $status = null)
    {
        $sql = "
            SELECT 
                c.complaint_code,
                c.title,
                c.location,
                c.content,
                c.created_at,
                c.status,
                u.username AS reporter_name,
                u.phone AS reporter_phone
            FROM complaints AS c
            LEFT JOIN users AS u ON c.user_id = u.id
            WHERE 1=1
        ";

        $params = [];
        if ($startDate) {
            $sql .= " AND c.created_at >= ?";
            $params[] = $startDate;
        }

        if ($endDate) {
            $sql .= " AND c.created_at <= ?";
            $params[] = $endDate . ' 23:59:59';
        }

        if ($status) {
            $sql .= " AND c.status = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY c.created_at DESC";

        $query = DB::query($sql);

        if ($params && count($params) > 0) {
            $query->bind(...$params);
        }

        return $query->fetchAll();
    }

    function getComplaintsWithResponses($startDate = null, $endDate = null, $status = null)
    {
        $sql = "
            SELECT 
                c.complaint_code,
                c.title,
                c.location,
                c.content,
                c.created_at AS complaint_date,
                c.status,
                u_created.username AS reporter_name,
                u_created.phone AS reporter_phone,
                u_responder.username AS responder_name,
                u_responder.phone AS responder_phone,
                cr.id AS response_id,
                cr.message AS response_message,
                cr.created_at AS response_date
            FROM complaints c
            LEFT JOIN complaint_responses AS cr ON c.id = cr.complaint_id
            LEFT JOIN users AS u_created ON c.user_id = u_created.id
            LEFT JOIN users AS u_responder ON cr.worker_id = u_responder.id
            WHERE 1=1
        ";

        $params = [];

        if ($startDate) {
            $sql .= " AND c.created_at >= ?";
            $params[] = $startDate;
        }

        if ($endDate) {
            $sql .= " AND c.created_at <= ?";
            $params[] = $endDate . ' 23:59:59';
        }

        if ($status) {
            $sql .= " AND c.status = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY c.created_at DESC, cr.created_at ASC";

        $query = DB::query($sql);

        if ($params && count($params) > 0) {
            $query->bind(...$params);
        }

        $results = $query->fetchAll();

        $complaints = [];
        foreach ($results as $row) {
            $code = $row['complaint_code'];

            if (!isset($complaints[$code])) {
                $complaints[$code] = [
                    'complaint_code' => $row['complaint_code'],
                    'title' => $row['title'],
                    'location' => $row['location'],
                    'content' => $row['content'],
                    'created_at' => $row['complaint_date'],
                    'status' => $row['status'],
                    'reporter_name' => $row['reporter_name'],
                    'reporter_phone' => $row['reporter_phone'],
                    'responses' => []
                ];
            }

            if ($row['response_id']) {
                $complaints[$code]['responses'][] = [
                    'id' => $row['response_id'],
                    'message' => $row['response_message'],
                    'created_at' => $row['response_date'],
                    'responder_name' => $row['responder_name'],
                    'responder_phone' => $row['responder_phone'],
                ];
            }
        }

        return array_values($complaints);
    }
}
