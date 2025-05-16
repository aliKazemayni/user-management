<?php

namespace Core\Database\Traits;

use PDO;
use PDOStatement;

trait Fetchable
{
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