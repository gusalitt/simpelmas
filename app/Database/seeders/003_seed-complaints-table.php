<?php

use App\Foundation\Database\DB;

$dummyComplaints = [
    [
        'title' => 'Jalan Amblas di Jl. Sudirman',
        'location' => 'Jl. Sudirman',
        'content' => 'Jalan amblas sedalam 2 meter setelah hujan deras semalam. Mengganggu akses kendaraan roda empat.',
        'image_url' => null,
        'status' => 'new',
    ],
    [
        'title' => 'TPS Liar di Kelurahan Menteng',
        'location' => 'Kelurahan Menteng',
        'content' => 'Penumpukan sampah selama 3 minggu di pinggir jalan. Menimbulkan bau tidak sedap.',
        'image_url' => null,
        'status' => 'done',
    ],
    [
        'title' => 'Antrean Puskesmas 3 Jam',
        'location' => 'Puskesmas Bandung',
        'content' => 'Pasien lansia mengeluh antrean panjang hingga 3 jam untuk berobat rutin.',
        'image_url' => null,
        'status' => 'processed',
    ],
    [
        'title' => 'Lampu Jalan Mati di Perumahan',
        'location' => 'Perumahan Griya Asri',
        'content' => 'Lampu penerangan jalan di kompleks perumahan mati total selama 1 minggu. Rawan kriminalitas.',
        'image_url' => null,
        'status' => 'new',
    ],
    [
        'title' => 'Banjir Setinggi 50cm',
        'location' => 'Kelurahan Cililitan',
        'content' => 'Banjir merendam 200 rumah warga setelah hujan deras selama 6 jam. Warga membutuhkan bantuan.',
        'image_url' => null,
        'status' => 'processed',
    ],
    [
        'title' => 'Pungli di Kantor Kelurahan',
        'location' => 'Kantor Kelurahan Sukamaju',
        'content' => 'Warga diminta membayar uang tidak resmi untuk mempercepat pengurusan KTP dan KK.',
        'image_url' => null,
        'status' => 'new',
    ],
    [
        'title' => 'Bahu Jalan Rusak',
        'location' => 'Jl. Raya Pasar Minggu',
        'content' => 'Bahu jalan rusak parah dan berlubang di beberapa titik. Sering menyebabkan kecelakaan motor.',
        'image_url' => null,
        'status' => 'done',
    ],
    [
        'title' => 'Saluran Air Tersumbat',
        'location' => 'Gang Mawar No. 5',
        'content' => 'Saluran air tersumbat sampah dan lumpur. Air tidak mengalir selama 2 minggu.',
        'image_url' => null,
        'status' => 'new',
    ],
    [
        'title' => 'Kabel Listrik Putus',
        'location' => 'Jl. Merdeka No. 10',
        'content' => 'Kabel listrik putus dan menjuntai di tengah jalan. Sangat berbahaya bagi pengendara.',
        'image_url' => null,
        'status' => 'processed',
    ],
    [
        'title' => 'Parkir Liar di Trotoar',
        'location' => 'Jl. Thamrin',
        'content' => 'Mobil-mobil parkir di trotoar pejalan kaki. Mengganggu akses difabel dan pejalan kaki.',
        'image_url' => null,
        'status' => 'new',
    ],
];

return [
    'run' => function (array &$context) use ($dummyComplaints) {
        $context['complaints'] = [];
        $users = array_filter($context['users'], fn ($user) => $user['role'] === 'citizen');
        $workers = array_filter($context['users'], fn ($user) => $user['role'] === 'worker');
        
        foreach ($dummyComplaints as $complaint) {
            $id = uuid();

            DB::query(
                "INSERT INTO complaints 
                (id, complaint_code, user_id, category_id, title, location, content, image_url, taken_by, taken_at, status, completed_by, completed_at) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            )
                ->bind(
                    $id,
                    generateComplaintCode(),
                    getRandomId($users),
                    getRandomId($context['categories']),
                    $complaint['title'],
                    $complaint['location'],
                    $complaint['content'],
                    $complaint['image_url'],
                    ($complaint['status'] !== 'new') ? getRandomId($workers) : null,
                    ($complaint['status'] !== 'new') ? date('Y-m-d H:i:s') : null,
                    $complaint['status'],
                    ($complaint['status'] === 'done') ? getRandomId($workers) : null,
                    ($complaint['status'] === 'done') ? date('Y-m-d H:i:s') : null,
                )
                ->execute();

            $context['complaints'][] = array_merge($complaint, ['id' => $id]);
        }
    }
];
