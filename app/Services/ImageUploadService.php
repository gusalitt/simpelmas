<?php

namespace App\Services;

class ImageUploadService
{
    private static string $uploadPath = '';
    private static int $maxSize = 1024 * 1024 * 2; // 2MB
    private static array $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];

    private static function ensureDirectoryExists(string $uploadPath)
    {
        $basePath = rtrim(str_replace('\\', '/', realpath(__DIR__ . '/../../')), '/');
        self::$uploadPath = $basePath . '/public/assets/uploads/' . rtrim($uploadPath, '/') . '/';
        self::$uploadPath = preg_replace('#/+#', '/', self::$uploadPath);

        if (!is_dir(self::$uploadPath)) {
            mkdir(self::$uploadPath, 0755, true);
        }

        return self::$uploadPath;
    }

    private static function validateFile(string $fileInputName)
    {
        if (!isset($_FILES[$fileInputName])) {
            return back('File tidak ditemukan');
        }

        $file = $_FILES[$fileInputName];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'File melebihi ukuran maksimum yang diizinkan server',
                UPLOAD_ERR_FORM_SIZE => 'File melebihi ukuran maksimum yang ditentukan form',
                UPLOAD_ERR_PARTIAL => 'File hanya terupload sebagian',
                UPLOAD_ERR_NO_FILE => 'Tidak ada file yang diupload',
                UPLOAD_ERR_NO_TMP_DIR => 'Folder temporary tidak ditemukan',
                UPLOAD_ERR_CANT_WRITE => 'Gagal menulis file ke disk',
                UPLOAD_ERR_EXTENSION => 'Upload dihentikan oleh ekstensi PHP'
            ];
            $message = $errorMessages[$file['error']] ?? 'Ada kesalahan saat mengupload file';
            return back($message);
        }

        if ($file['size'] > self::$maxSize) {
            return back('Ukuran file terlalu besar! Maksimal 2MB.');
        }

        if (!in_array($file['type'], self::$allowedTypes)) {
            return back('Tipe file tidak didukung. Hanya file PNG, JPG, dan JPEG diizinkan.');
        }

        $imageInfo = getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            return back('File bukan gambar valid.');
        }

        return true;
    }

    public static function upload(string $uploadPath, string $fileInputName)
    {
        self::ensureDirectoryExists($uploadPath);
        self::validateFile($fileInputName);

        $file = $_FILES[$fileInputName];
        
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $fileName = uniqid() . '_' . time() . '.' . $extension;
        $targetFilePath = self::$uploadPath . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            return back('Gagal mengupload file.');
        }

        return $fileName;
    }

    public static function delete(string $fileName)
    {
        $filePath = self::$uploadPath . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        return true;
    }

    public static function update(string $uploadPath, string $fileInputName, ?string $oldFileName = null)
    {
        self::ensureDirectoryExists($uploadPath);
        self::validateFile($fileInputName);

        if ($oldFileName && !self::delete($oldFileName)) {
            return back('Gagal mengupdate file.');
        }

        $fileName = self::upload($uploadPath, $fileInputName);
        return $fileName;
    }
}