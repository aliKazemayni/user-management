<?php

namespace Core\Database;

use Core\Database\Traits\Fetchable;
use Core\Log\Error;
use PDOException;
use PDOStatement;

class QueryBuilder
{
    use Fetchable;
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
}