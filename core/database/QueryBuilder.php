<?php

namespace Core\Database;

use PDOException;
use Core\Database\Database;

class QueryBuilder
{
    private PDOStatement $builder;
    public function __construct(string $sql)
    {
        try {
            $this->builder = Database::connect()->prepare($sql);
        } catch (PDOException $e) {
            die("Prepare failed: " . $e->getMessage());
        }
    }

    public function bind(array $params = []): self
    {
        try {
            $this->builder->execute($params);
        } catch (PDOException $e) {
            die("Execute failed: " . $e->getMessage());
        }
        return $this;
    }
}