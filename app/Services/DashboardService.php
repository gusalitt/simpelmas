<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ComplaintRepository;

class DashboardService
{
    private ComplaintRepository $complaintRepository;
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->complaintRepository = new ComplaintRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    public function getStaffDashboardData()
    {
        $stats = $this->complaintRepository->findComplaintStats();
        $categoryStats = $this->categoryRepository->findCategoryStats();
        $overdue = $this->getOverdueComplaints();
        $monthlyStats = $this->getMonthlyStats();

        return [
            'stats' => $stats,
            'categoryStats' => $categoryStats,
            'overdue' => $overdue,
            'monthlyStats' => $monthlyStats,
        ];
    }

    public function getUserDashboardData()
    {
        $userId = auth()->id();
        $stats = $this->complaintRepository->findComplaintStats($userId);
        $recentComplaints = $this->complaintRepository->getRecentComplaintsByUser($userId);
        
        return [
            'stats' => $stats,
            'recentComplaints' => $recentComplaints,
        ];
    }

    private function getOverdueComplaints()
    {
        $complaints = $this->complaintRepository->findOverdueComplaints();

        $overdue = [];
        $today = new \DateTime();

        foreach ($complaints as $complaint) {
            $isOverdue = false;
            $overdueDays = 0;
            $slaLimit = 0;

            if ($complaint['status'] === 'new') {
                $createdAt = new \DateTime($complaint['created_at']);
                $diff = $today->diff($createdAt);
                $days = $diff->days;

                if ($days > 3) {
                    $isOverdue = true;
                    $overdueDays = $days - 3;
                    $slaLimit = 3;
                }
            } elseif ($complaint['status'] === 'processed') {
                if (!empty($complaint['taken_at'])) {
                    $takenAt = new \DateTime($complaint['taken_at']);
                    $diff = $today->diff($takenAt);
                    $days = $diff->days;

                    if ($days > 7) {
                        $isOverdue = true;
                        $overdueDays = $days - 7;
                        $slaLimit = 7;
                    }
                }
            }

            if ($isOverdue) {
                $complaint['overdue_days'] = $overdueDays;
                $complaint['sla_limit'] = $slaLimit;
                $overdue[] = $complaint;
            }
        }

        usort($overdue, function ($a, $b) {
            return $b['overdue_days'] - $a['overdue_days'];
        });

        return $overdue;
    }

    private function getMonthlyStats()
    {
        $monthlyStats = $this->complaintRepository->findMonthlyStats();

        $months = [];
        $statusList = ['new', 'processed', 'done'];
        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = [
                'month' => $monthNames[$i],
                'year' => date('Y'),
                'new' => 0,
                'processed' => 0,
                'done' => 0,
                'total' => 0,
                'percentages' => [
                    'new' => 0,
                    'processed' => 0,
                    'done' => 0,
                ]
            ];
        }

        foreach ($monthlyStats as $row) {
            $monthNum = (int) $row['month'];
            $status = $row['status'];
            $total = (int) $row['total'];

            if (isset($months[$monthNum][$status])) {
                $months[$monthNum][$status] = $total;
                $months[$monthNum]['total'] += $total;
            }
        }

        foreach ($months as $monthNum => $month) {
            $total = $month['total'];

            foreach ($statusList as $status) {
                if ($total > 0) {
                    $percentage = round(($month[$status] / $total) * 100, 1);
                } else {
                    $percentage = 0;
                }

                $months[$monthNum]['percentages'][$status] = $percentage;
            }
        }

        return $months;
    }
}
