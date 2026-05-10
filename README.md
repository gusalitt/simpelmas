# SIMPELMAS - Sistem Pengaduan & Laporan Masyarakat

SIMPELMAS adalah aplikasi web berbasis PHP Native untuk pengaduan dan laporan masyarakat. Aplikasi ini memungkinkan masyarakat untuk melaporkan permasalahan, petugas untuk memproses pengaduan, dan admin untuk mengelola seluruh sistem.

Website ini memiliki tiga peran pengguna yaitu Masyarakat (pelapor), Petugas, dan Admin. Masing-masing peran memiliki hak akses yang berbeda sesuai dengan fungsinya.

## Fitur

- Buat pengaduan dengan unggah foto pendukung
- Pantau status pengaduan (Baru, Diproses, Selesai)
- Diskusi melalui fitur komentar pada setiap pengaduan
- Dashboard untuk petugas dan admin
- Kelola kategori pengaduan
- Cetak laporan dalam format PDF
- Kelola data pengguna (khusus admin)
- Update profil dan password

## Teknologi yang Digunakan

- Frontend: HTML, CSS, Tailwind CSS, JavaScript
- Backend: PHP Native
- Database: MySQL
- Web Server: Apache (XAMPP / Laragon)

## Cara Menjalankan Proyek Ini

### 1. Clone repositori

```bash
git clone https://github.com/gusalitt/simpelmas.git
cd simpelmas
```

### 2. Install dependencies

```bash
pnpm install
```

### 3. Copy .env.example ke .env

```bash
cp .env.example .env
```

### 4. Edit file .env

Buka file `.env` dan sesuaikan konfigurasi berikut:

```env
APP_URL="http://localhost/simpelmas"

DB_CONNECTION="mysql"
DB_HOST="localhost"
DB_PORT="3306"
DB_NAME="your_database_name"
DB_USERNAME="root"
DB_PASSWORD=""

ENCRYPTION_KEY="your_encryption_key"
```

### 5. Buat database

Buat database baru di MySQL sesuai dengan `DB_NAME` yang sudah Anda set di `.env`.

### 6. Jalankan migrasi dan seeder

```bash
cd app/Database/
php migrate.php && php seed.php
```

### 7. Akses aplikasi

Buka browser dan akses alamat berikut:

```
http://localhost/simpelmas
```