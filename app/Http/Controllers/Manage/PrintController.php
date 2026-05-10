<?php

namespace App\Http\Controllers\Manage;

use App\Foundation\Http\Controller;
use App\Http\Request\PrintRequest;
use App\Services\PrintService;

class PrintController extends Controller
{
    protected array $requests = [
        'printComplaint' => PrintRequest::class
    ];

    private PrintService $printService;

    public function __construct()
    {
        $this->printService = new PrintService();
    }

    public function printComplaintPreview()
    {
        return view()::render('pages.manage.print_complaint');
    }

    public function printComplaint()
    {
        $data = $this->validated();
        $complaints = $this->printService->printComplaint($data);

        $data = [
            'complaints' => $complaints,
            'metadata' => [
                'print_option' => $data['print_option'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date']
            ]
        ];


        $viewFile = $data['metadata']['print_option'] === 'complaint-only' 
            ? 'pages.manage.print.complaint_only' 
            : 'pages.manage.print.complaint_with_response';

        return view()::render($viewFile, compact('data'));
    }
}
