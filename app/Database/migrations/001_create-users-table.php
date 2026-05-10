<?php

use App\Foundation\Database\DB;

return [
    'up' => function () {
        DB::query(
            "CREATE TABLE IF NOT EXISTS users (
                id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
                username VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL,
                password VARCHAR(255) NOT NULL,
                avatar VARCHAR(255) NULL,
                phone VARCHAR(20) NULL,
                address VARCHAR(255) NULL,
                role ENUM('citizen', 'worker', 'admin') DEFAULT 'citizen',
                
                deleted_at DATETIME NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                
                INDEX idx_role (role),
                INDEX idx_email (email)
            )"
        )->execute();
    },

    'down' => function () {
        DB::query(
            "DROP TABLE IF EXISTS users"
        )->execute();
    }
];