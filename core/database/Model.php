<?php

namespace Core\Database;

use Core\Database\Traits\Crudable;

abstract class Model
{
    use Crudable;
    abstract protected static function table(): string;

    private static function queryBuilder(string $query): string
    {
        $table = static::table();
        return str_replace('@tn', $table, $query);
    }
}