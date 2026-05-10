<?php

use App\Foundation\Database\DB;

$dummyComplaintResponses = [
    // Step 1: (New → Verified)
    [
        'message' => 'Terima kasih atas laporan Anda. Tim kami akan segera melakukan verifikasi data dan lokasi kejadian.',
        'image_url' => null,
    ],
    [
        'message' => 'Laporan Anda telah kami terima dan akan diteruskan ke instansi terkait sesuai dengan jenis permasalahan.',
        'image_url' => null,
    ],
    [
        'message' => 'Terima kasih sudah melaporkan. Data Anda akan kami jaga kerahasiaannya sesuai dengan ketentuan yang berlaku.',
        'image_url' => null,
    ],
    [
        'message' => 'Laporan Anda telah masuk ke sistem. Mohon tunggu proses verifikasi maksimal 24 jam.',
        'image_url' => null,
    ],

    // Step 2: (Verified → Processed)
    [
        'message' => 'Laporan Anda sedang dalam proses penanganan oleh petugas terkait. Mohon menunggu informasi selanjutnya.',
        'image_url' => null,
    ],
    [
        'message' => 'Petugas sedang melakukan pengecekan lapangan terkait laporan yang Anda sampaikan.',
        'image_url' => null,
    ],
    [
        'message' => 'Proses verifikasi sedang berlangsung. Kami akan menginformasikan perkembangan lebih lanjut.',
        'image_url' => null,
    ],
    [
        'message' => 'Laporan Anda sedang dikoordinasikan dengan instansi terkait untuk tindak lanjut lebih lanjut.',
        'image_url' => null,
    ],
    [
        'message' => 'Tim kami sedang menyusun rencana tindak lanjut untuk permasalahan yang Anda laporkan.',
        'image_url' => null,
    ],

    // Step 3: (Processed → Done)
    [
        'message' => 'Laporan Anda telah selesai ditangani. Terima kasih atas partisipasi Anda dalam membangun pelayanan publik yang lebih baik.',
        'image_url' => null,
    ],
    [
        'message' => 'Penanganan laporan Anda telah selesai. Status akan diperbarui secara berkala di dashboard Anda.',
        'image_url' => null,
    ],
    [
        'message' => 'Laporan Anda telah berhasil ditindaklanjuti. Mohon pantau terus statusnya melalui aplikasi SIMPELMAS.',
        'image_url' => null,
    ],
    [
        'message' => 'Permasalahan yang Anda laporkan telah kami selesaikan. Terima kasih telah menggunakan SIMPELMAS.',
        'image_url' => null,
    ],
];

return [
    'run' => function (array &$context) use ($dummyComplaintResponses) {
        $context['complaint_responses'] = [];
        $workers = array_filter($context['users'], fn($user) => $user['role'] === 'worker');
        $complaints = array_filter($context['complaints'], fn($complaint) => $complaint['status'] !== 'new');

        foreach ($dummyComplaintResponses as $complaintResponse) {
            $id = uuid();

            DB::query(
                "INSERT INTO complaint_responses 
                    (id, complaint_id, worker_id, message, image_url) 
                    VALUES 
                    (?, ?, ?, ?, ?)"
            )
                ->bind(
                    $id,
                    getRandomId($complaints),
                    getRandomId($workers),
                    $complaintResponse['message'],
                    $complaintResponse['image_url']
                )
                ->execute();

            $context['complaint_responses'][] = array_merge($complaintResponse, ['id' => $id]);
        }
    },
];
