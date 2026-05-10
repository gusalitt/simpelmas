<?php

namespace App\Models;

use App\Foundation\Database\Model;

class ComplaintResponse extends Model
{
    protected string $table = 'complaint_responses';

    protected string $primaryKey = 'id';

    protected array $fillable = [
        'complaint_id',
        'worker_id',
        'message',
        'image_url',
    ];
}