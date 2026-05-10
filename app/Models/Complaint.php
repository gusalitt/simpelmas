<?php

namespace App\Models;

use App\Foundation\Database\Model;

class Complaint extends Model
{
    protected string $table = 'complaints';

    protected string $primaryKey = 'id';

    protected array $fillable = [
        'complaint_code',
        'user_id',
        'category_id',
        'title',
        'location',
        'content',
        'image_url',
        'taken_by',
        'taken_at',
        'status',
        'completed_by',
        'completed_at',
    ];
}