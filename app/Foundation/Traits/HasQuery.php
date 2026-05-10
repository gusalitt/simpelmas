<?php

namespace App\Foundation\Traits;

use App\Foundation\Database\QueryBuilder;
use App\Foundation\Database\ConnectionResolver;

trait HasQuery
{
    public static function query(string $sql): QueryBuilder
    {
        $instance = new static();
        $finalSql = str_replace('{table}', $instance->table, $sql);
        return ConnectionResolver::resolve($instance->connection, $finalSql);
    }

    public static function insert(array $data): int|string
    {
        $instance = new static();
        $id = uuid();

        $fillableKeys = array_filter($data, fn($key) => in_array($key, $instance->fillable), ARRAY_FILTER_USE_KEY);
        $fillableKeys['id'] = $id;

        $now = date('Y-m-d H:i:s');
        if (!array_key_exists('created_at', $fillableKeys)) {
            $fillableKeys['created_at'] = $now;
        }
        if (!array_key_exists('updated_at', $fillableKeys)) {
            $fillableKeys['updated_at'] = $now;
        }

        $fillableValues = array_values($fillableKeys);
        $cols = implode(', ', array_keys($fillableKeys));
        $holders = implode(', ', array_fill(0, count($fillableKeys), '?'));
        $sql = "INSERT INTO {table} ({$cols}) VALUES ({$holders})";

        static::query($sql)
            ->bind(...$fillableValues)
            ->execute();

        return $id;
    }

    public static function update(array $data, array $where): int
    {
        $instance = new static();
        $fillableKeys = array_filter($data, fn($key) => in_array($key, $instance->fillable), ARRAY_FILTER_USE_KEY);
        $now = date('Y-m-d H:i:s');
        if (!array_key_exists('updated_at', $fillableKeys)) {
            $fillableKeys['updated_at'] = $now;
        }

        $fillableValues = array_values($fillableKeys);
        $whereValues = array_values($where);

        $set = implode(', ', array_map(fn($k) => "{$k} = ?", array_keys($fillableKeys)));
        $conditions = implode(' AND ', array_map(fn($k) => "{$k} = ?", array_keys($where)));

        $params = [...$fillableValues, ...$whereValues];
        $sql = "UPDATE {table} SET {$set} WHERE {$conditions}";

        return static::query($sql)
            ->bind(...$params)
            ->affectedRows();
    }

    public static function delete(array $where): int
    {
        $conditions = implode(' AND ', array_map(fn($k) => "{$k} = ?", array_keys($where)));

        $sql = "DELETE FROM {table} WHERE {$conditions}";
        $params = array_values($where);

        return static::query($sql)
            ->bind(...$params)
            ->affectedRows();
    }
}
