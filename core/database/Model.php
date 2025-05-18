<?php

namespace Core\Database;

abstract class Model
{
    abstract protected static function table(): string;

    public static function all(): array
    {
        return Database::query("SELECT * FROM " . static::table())->all();
    }
}