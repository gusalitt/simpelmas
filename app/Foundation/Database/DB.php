<?php

namespace App\Foundation\Database;

use App\Foundation\Database\ConnectionResolver;

class DB
{
    public static function query(string $sql): QueryBuilder
    {
        return ConnectionResolver::resolve(null, $sql);
    }

    public static function transaction(callable $callback): mixed
    {
        return ConnectionResolver::transaction($callback);
    }
}