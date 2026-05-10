<?php

namespace App\Foundation\Database;

use App\Foundation\Traits\HasQuery;

abstract class Model
{
    use HasQuery;

    protected string $table = '';

    protected string $primaryKey = 'id';

    protected array $fillable = [];

    protected array $hidden = [];

    protected ?string $connection = null;
}
