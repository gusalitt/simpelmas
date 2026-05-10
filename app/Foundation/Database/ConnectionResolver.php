<?php

namespace App\Foundation\Database;

use App\Foundation\Database\QueryBuilder;

class ConnectionResolver
{
    private static array $config = [];
    private static string $default = 'mysql';
    private static array $resolvedQBs = [];
    private static array $transactionPdo = [];

    public static function boot(array $config): void
    {
        self::$config = $config['connections'] ?? [];
        self::$default = $config['default'] ?? 'mysql';
    }

    public static function resolve(?string $connectionName = null, ?string $sql = null): QueryBuilder
    {
        $name = $connectionName ?? self::$default;

        if (isset(self::$transactionPdo[$name])) {
            $pdo = self::$transactionPdo[$name];
            $qb = new QueryBuilder($pdo);
            $qb->setSql($sql);
            return $qb;
        }

        if (!isset(self::$config[$name])) {
            throw new \RuntimeException("Connection [{$name}] not configured.");
        }

        if (!isset(self::$resolvedQBs[$name])) {
            $config = self::$config[$name];
            $pdo = Connection::resolve($name, $config);

            self::$resolvedQBs[$name] = new QueryBuilder($pdo);
        }

        $qb = clone self::$resolvedQBs[$name];

        $qb->setSql($sql);
        return $qb;
    }

    public static function transaction(callable $callback, ?string $connectionName = null): mixed
    {
        $name = $connectionName ?? self::$default;

        if (!isset(self::$config[$name])) {
            throw new \RuntimeException("Connection [{$name}] not configured.");
        }

        $config = self::$config[$name];
        $pdo = Connection::resolve($name, $config);

        try {
            $pdo->beginTransaction();
            self::$transactionPdo[$name] = $pdo;

            $result = $callback();
            $pdo->commit();

            return $result;
        } catch (\Throwable $th) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            throw $th;
        } finally {
            unset(self::$transactionPdo[$name]);
        }
    }

    public static function setDefault(string $name): void
    {
        self::$default = $name;
    }

    public static function addConnection(string $name, array $config): void
    {
        self::$config[$name] = $config;
    }
}
