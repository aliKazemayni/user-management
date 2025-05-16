<?php

namespace Core\Database;

use Core\Log\Error;
use PDO;
use PDOException;
use PDOStatement;

class QueryBuilder
{
    private PDOStatement $builder;
    public function __construct(string $query)
    {
        try {
            $this->builder = Database::connect()->prepare($query);
        } catch (PDOException $e) {
            Error::database($e->getMessage(), true, true);
        }
    }

    public function bind(array $params = []): self
    {
        try {
            $this->builder->execute($params);
        } catch (PDOException $e) {
            Error::database($e->getMessage(), true, true);
        }
        return $this;
    }

    public function all(): array
    {
        return $this->builder->fetchAll(PDO::FETCH_ASSOC);
    }

    public function allObj(): array
    {
        return $this->builder->fetchAll(PDO::FETCH_OBJ);
    }

    public function one(): mixed
    {
        return $this->builder->fetch(PDO::FETCH_ASSOC);
    }

    public function oneObj(): mixed
    {
        return $this->builder->fetch(PDO::FETCH_OBJ);
    }

    public function fetchFunc(callable $callback): array|false
    {
        return $this->builder->fetchAll(PDO::FETCH_FUNC, $callback);
    }

    public function count(): int
    {
        return $this->builder->rowCount();
    }

    public function raw(): PDOStatement
    {
        return $this->builder;
    }
}