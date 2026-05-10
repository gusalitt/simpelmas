<?php

namespace App\Models;

use App\Foundation\Database\Model;

class User extends Model
{
    protected string $table = 'users';

    protected string $primaryKey = 'id';

    protected array $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'avatar',
        'address',
        'role',
        'deleted_at'
    ];

    protected array $hidden = ['password'];
}