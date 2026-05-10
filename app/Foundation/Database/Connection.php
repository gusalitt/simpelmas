<?php

namespace App\Foundation\Database;

use PDO;
use PDOException;
use RuntimeException;

class Connection
{
    private static array $instances = [];

    public static function resolve(string $name, array $config): PDO
    {
        if (isset(self::$instances[$name])) {
            return self::$instances[$name];
        }

        self::$instances[$name] = self::createConnection($config);
        return self::$instances[$name];
    }

    public static function disconnect(string $name): void
    {
        unset(self::$instances[$name]);
    }

    public static function disconnectAll(): void
    {
        self::$instances = [];
    }

    private static function createConnection(array $config): PDO
    {
        $dsn = self::buildDsn($config);

        try {
            $pdo = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );

            // Set charset after connect for MySQL
            if ($config['driver'] === 'mysql') {
                $charset = $config['charset'] ?? 'utf8mb4';
                $pdo->exec("SET NAMES '{$charset}'");
            }

            return $pdo;
        } catch (\Throwable $th) {
            throw new RuntimeException("Connection failed [{$config['driver']}]: " . $th->getMessage());
        }
    }

    private static function buildDsn(array $config): string
    {
        $driver = $config['driver'] ?? 'mysql';
        $host   = $config['host']   ?? '127.0.0.1';
        $port   = $config['port']   ?? ($driver === 'pgsql' ? 5432 : 3306);
        $dbname = $config['dbname'] ?? '';

        return match ($driver) {
            'mysql' => "mysql:host={$host};port={$port};dbname={$dbname}",
            'pgsql' => "pgsql:host={$host};port={$port};dbname={$dbname}",
            default => throw new RuntimeException("Unsupported driver: {$driver}"),
        };
    }
}
