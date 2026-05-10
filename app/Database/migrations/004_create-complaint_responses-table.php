<?php

use App\Foundation\Database\DB;

return [
    'up' => function () {
        DB::query(
            "CREATE TABLE IF NOT EXISTS complaint_responses (
                id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
                complaint_id CHAR(36) NOT NULL,
                worker_id CHAR(36) NOT NULL,
                message TEXT NOT NULL,
                image_url VARCHAR(255) NULL,
                
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                
                FOREIGN KEY (complaint_id) REFERENCES complaints(id) ON DELETE CASCADE,
                FOREIGN KEY (worker_id) REFERENCES users(id) ON DELETE CASCADE,
                
                INDEX idx_complaint_id (complaint_id),
                INDEX idx_created_at (created_at),
                INDEX idx_worker_id (worker_id)
            )"
        )->execute();
    },

    'down' => function () {
        DB::query(
            "DROP TABLE IF EXISTS complaint_responses"
        )->execute();
    }
];