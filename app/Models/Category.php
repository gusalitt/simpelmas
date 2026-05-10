<?php

namespace App\Models;

use App\Foundation\Database\Model;

class Category extends Model
{
    protected string $table = 'categories';

    protected string $primaryKey = 'id';

    protected array $fillable = [
        'name',
        'description',
        'deleted_at',
    ];
}