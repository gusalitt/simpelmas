<?php

use App\Foundation\Database\DB;

$categories = [
    ['name' => 'Infrastruktur', 'description' => 'Jalan rusak, jembatan, lampu jalan, dll'],
    ['name' => 'Kebersihan', 'description' => 'Sampah, TPS liar, drainase tersumbat, dll'],
    ['name' => 'Kesehatan', 'description' => 'Fasilitas kesehatan, layanan puskesmas, dll'],
    ['name' => 'Pelayanan Publik', 'description' => 'Pelayanan administrasi, perizinan, dll'],
    ['name' => 'Lingkungan', 'description' => 'Polusi, banjir, pohon tumbang, dll'],
    ['name' => 'Keamanan', 'description' => 'Lampu jalan mati, keamanan lingkungan, dll'],
    ['name' => 'Pendidikan', 'description' => 'Sekolah, fasilitas pendidikan, dll'],
    ['name' => 'Sosial', 'description' => 'Bansos, layanan sosial, dll'],
];

return [
    'run' => function (array &$context) use ($categories) {
        $context['categories'] = [];

        foreach ($categories as $category) {
            $exists = DB::query("SELECT id FROM categories WHERE name = ?")->bind($category['name'])->fetchOne();
            
            if (!$exists) {
                $id = uuid(); 
                DB::query("INSERT INTO categories (id, name, description, deleted_at) VALUES (?, ?, ?, NULL)")
                    ->bind($id, $category['name'], $category['description'])
                    ->execute();

                $context['categories'][] = array_merge($category, ['id' => $id]);
            }
        }
    },
];
