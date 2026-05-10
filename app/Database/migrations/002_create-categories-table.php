<?php

use App\Foundation\Database\DB;

return [
    'up' => function () {
        DB::query(
            "CREATE TABLE IF NOT EXISTS categories (
                id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
                name VARCHAR(50) NOT NULL,
                description TEXT NULL,
                
                deleted_at TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )"
        )->execute();
    },

    'down' => function () {
        DB::query(
            "DROP TABLE IF EXISTS categories"
        )->execute();
    }
];