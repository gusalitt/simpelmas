<?php

namespace App\Foundation\Database;

use App\Foundation\Support\Logger;
use PDO;
use PDOStatement;

class QueryBuilder
{
    private string $sql;
    private array $params = [];
    private ?PDOStatement $stmt = null;
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchOne(): ?array
    {
        $this->execute();
        return $this->stmt->fetch() ?: null;
    }

    public function fetchAll(): array
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    public function affectedRows(): int
    {
        $this->execute();
        return $this->stmt->rowCount();
    }

    public function lastInsertId(): string
    {
        $this->execute();
        return $this->pdo->lastInsertId();
    }

    public function bind(mixed ...$params): static
    {
        $this->params = $params;
        return $this;
    }

    public function execute()
    {
        $startTime = microtime(true);

        $this->stmt = $this->pdo->prepare($this->sql);
        $this->stmt->execute($this->params);

        $endTime = microtime(true);
        $timeMs = round(($endTime - $startTime) * 1000, 2);

        Logger::query($this->sql, $this->params, $timeMs);
    }

    public function setSql(string $sql): static
    {
        $this->sql = $sql;
        $this->params = [];
        $this->stmt = null;

        return $this;
    }
}
