<?php

use App\Foundation\Database\DB;

return [
    'up' => function () {
        DB::query(
            "CREATE TABLE IF NOT EXISTS complaints (
                id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
                complaint_code VARCHAR(20) UNIQUE NOT NULL,
                category_id CHAR(36) NULL,
                title VARCHAR(255) NOT NULL,
                location VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                image_url VARCHAR(255) NULL,
                user_id CHAR(36) NOT NULL,

                taken_by CHAR(36) NULL,
                taken_at TIMESTAMP NULL,
                status ENUM('new', 'processed', 'done') DEFAULT 'new',
                completed_by CHAR(36) NULL,
                completed_at TIMESTAMP NULL,
                
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (taken_by) REFERENCES users(id) ON DELETE SET NULL,
                FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
                FOREIGN KEY (completed_by) REFERENCES users(id) ON DELETE SET NULL,
                
                INDEX idx_status (status),
                INDEX idx_category (category_id),
                INDEX idx_created_at (created_at),
                INDEX idx_complaint_code (complaint_code),
                INDEX idx_taken_by (taken_by)
            )"
        )->execute();
    },

    'down' => function () {
        DB::query(
            "DROP TABLE IF EXISTS complaints"
        )->execute();
    }
];