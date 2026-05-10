<?php

namespace App\Repositories;

use App\Models\Complaint;

class ComplaintRepository
{
    public function findById(int|string $id)
    {
        return Complaint::query("SELECT * FROM {table} WHERE id = ?")->bind($id)->fetchOne();
    }

    public function findByIdAndStatus(int|string $id, ?string $status = null)
    {
        return Complaint::query("SELECT * FROM {table} WHERE id = ? AND status = ?")->bind($id, $status)->fetchOne();
    }

    public function findNewComplaints()
    {
        $sql = "
            SELECT
                cp.id,
                cp.complaint_code,
                cp.title,
                cp.location,
                cp.content,
                cp.image_url,
                cp.created_at,
                c.name AS category_name,
                u.username AS created_by
            FROM {table} AS cp
            INNER JOIN categories AS c ON cp.category_id = c.id
            INNER JOIN users AS u ON cp.user_id = u.id
            WHERE cp.status = 'new'
            ORDER BY cp.created_at DESC
        ";
        return Complaint::query($sql)->fetchAll();
    }

    public function findProcessingComplaints()
    {
        $sql = "
            SELECT
                cp.id,
                cp.complaint_code,
                cp.title,
                cp.location,
                cp.content,
                u_taken.username AS taken_by_name,
                cp.taken_at AS created_at,
                c.name AS category_name,
                u_created.username AS created_by
            FROM {table} AS cp
            INNER JOIN categories AS c ON cp.category_id = c.id
            LEFT JOIN users AS u_taken ON cp.taken_by = u_taken.id
            LEFT JOIN users AS u_created ON cp.user_id = u_created.id
            WHERE cp.status = 'processed'
            ORDER BY cp.taken_at DESC
        ";

        return Complaint::query($sql)->fetchAll();
    }

    public function findCompletedComplaints()
    {
        $sql = "
            SELECT
                cp.id,
                cp.complaint_code,
                cp.title,
                cp.location,
                cp.content,
                u_completed.username AS completed_by_name,
                cp.completed_at AS created_at,
                c.name AS category_name,
                u_created.username AS created_by
            FROM {table} AS cp
            INNER JOIN categories AS c ON cp.category_id = c.id
            LEFT JOIN users AS u_completed ON cp.completed_by = u_completed.id
            LEFT JOIN users AS u_created ON cp.user_id = u_created.id
            WHERE cp.status = 'done'
            ORDER BY cp.completed_at DESC
        ";

        return Complaint::query($sql)->fetchAll();
    }

    public function updateTakenBy($id, $takenBy)
    {
        return Complaint::update([
            'taken_by' => $takenBy,
            'taken_at' => date('Y-m-d H:i:s'),
            'status' => 'processed',
        ], [
            'id' => $id,
        ]);
    }

    public function findProcessingComplaintDetail($id)
    {
        $sql = "
            SELECT
                cp.id,
                cp.complaint_code,
                cp.title,
                cp.location,
                cp.content,
                cp.image_url,
                cp.created_at,
                cp.taken_at,
                cp.status,
                u_taken.username AS taken_by_name,
                u_created.username AS created_by_name,
                u_created.email AS user_email,
                u_created.phone AS user_phone,
                u_created.address AS user_address,
                c.name AS category_name
            FROM {table} AS cp
            INNER JOIN categories AS c ON cp.category_id = c.id
            INNER JOIN users AS u_created ON cp.user_id = u_created.id
            LEFT JOIN users AS u_taken ON cp.taken_by = u_taken.id
            WHERE cp.id = ? AND cp.status = 'processed'
            LIMIT 1
        ";

        return Complaint::query($sql)->bind($id)->fetchOne();
    }

    public function updateStatus($id, $status)
    {
        return Complaint::update([
            'status' => $status,
            'completed_at' => date('Y-m-d H:i:s'),
            'completed_by' => auth()->id(),
        ], [
            'id' => $id,
        ]);
    }

    public function findCompletedComplaintDetail($id)
    {
        $sql = "
            SELECT
                cp.id,
                cp.complaint_code,
                cp.title,
                cp.location,
                cp.content,
                cp.image_url,
                cp.created_at,
                cp.taken_at,
                cp.completed_at,
                cp.status,
                u_taken.username AS taken_by_name,
                u_completed.username AS completed_by_name,
                u_created.username AS created_by_name,
                u_created.email AS user_email,
                u_created.phone AS user_phone,
                u_created.address AS user_address,
                c.name AS category_name
            FROM {table} AS cp
            INNER JOIN categories AS c ON cp.category_id = c.id
            INNER JOIN users AS u_created ON cp.user_id = u_created.id
            LEFT JOIN users AS u_taken ON cp.taken_by = u_taken.id
            LEFT JOIN users AS u_completed ON cp.completed_by = u_completed.id
            WHERE cp.id = ? AND cp.status = 'done'
            LIMIT 1
        ";

        return Complaint::query($sql)->bind($id)->fetchOne();
    }

    public function findComplaintStats(?string $userId = null)
    {
        $sqlStats = "
            SELECT
                COUNT(*) AS complaint_count,
                SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) AS complaint_new_count,
                SUM(CASE WHEN status = 'processed' THEN 1 ELSE 0 END) AS complaint_processed_count,
                SUM(CASE WHEN status = 'done' THEN 1 ELSE 0 END) AS complaint_done_count
            FROM {table}
        ";

        if ($userId) {
            $sqlStats .= " WHERE user_id = ?";
        }
        $query = Complaint::query($sqlStats);

        if ($userId) {
            $query->bind($userId);
        }

        return $query->fetchOne();
    }

    public function findMonthlyStats()
    {
        $sql = "
            SELECT 
                MONTH(created_at) AS month,
                status,
                COUNT(*) AS total
            FROM {table}
            WHERE YEAR(created_at) = YEAR(CURDATE())
            GROUP BY month, status
        ";

        return Complaint::query($sql)->fetchAll();
    }

    public function findOverdueComplaints()
    {
        $sql = "
            SELECT 
                cp.complaint_code,
                cp.title,
                cp.status,
                cp.created_at,
                cp.taken_at,
                u_created.username AS created_by_name,
                u_taken.username AS taken_by_name
            FROM {table} AS cp
            LEFT JOIN users AS u_created ON cp.user_id = u_created.id
            LEFT JOIN users AS u_taken ON cp.taken_by = u_taken.id
            WHERE cp.status IN ('new', 'processed')
        ";

        return Complaint::query($sql)->fetchAll();
    }

    public function findComplaintByUserId($userId)
    {
        $sql = "
            SELECT
                cp.id,
                cp.complaint_code,
                cp.title,
                cp.content,
                cp.created_at,
                cp.status,
                c.name AS category_name
            FROM {table} AS cp
            INNER JOIN categories AS c ON cp.category_id = c.id
            WHERE cp.user_id = ?
            ORDER BY cp.created_at DESC
        ";

        return Complaint::query($sql)->bind($userId)->fetchAll();
    }

    public function findComplaintDetailById($id)
    {
        $sql = "
            SELECT
                cp.id,
                cp.complaint_code,
                cp.title,
                cp.location,
                cp.content,
                cp.image_url,
                cp.created_at,
                cp.taken_at,
                cp.completed_at,
                cp.status,
                u_taken.username AS taken_by_name,
                u_completed.username AS completed_by_name,
                u_created.username AS created_by_name,
                u_created.email AS user_email,
                u_created.phone AS user_phone,
                u_created.address AS user_address,
                c.name AS category_name
            FROM {table} AS cp
            INNER JOIN categories AS c ON cp.category_id = c.id
            INNER JOIN users AS u_created ON cp.user_id = u_created.id
            LEFT JOIN users AS u_taken ON cp.taken_by = u_taken.id
            LEFT JOIN users AS u_completed ON cp.completed_by = u_completed.id
            WHERE cp.id = ?
            LIMIT 1
        ";

        return Complaint::query($sql)->bind($id)->fetchOne();
    }

    public function create(array $data)
    {
        return Complaint::insert($data);
    }

    public function getRecentComplaintsByUser(string $userId)
    {
        $sql = "
            SELECT
                c.title,
                c.status,
                c.created_at,
                ct.name AS category_name
            FROM {table} AS c
            INNER JOIN categories AS ct ON c.category_id = ct.id
            WHERE c.user_id = ?
            ORDER BY c.created_at DESC
            LIMIT 10
        ";

        return Complaint::query($sql)->bind($userId)->fetchAll();
    }
}
