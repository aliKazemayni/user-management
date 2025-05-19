<?php

namespace Core\Database;

abstract class Model
{
    abstract protected static function table(): string;

    public static function all(): array
    {
        return Database::query(self::queryBuilder("SELECT * FROM @tn"))->all();
    }

    public static function find(int $id): array
    {
        return Database::query(self::queryBuilder("SELECT * FROM @tn where id = $id"))->one();
    }

    private static function queryBuilder(string $query): string
    {
        $table = static::table();
        return str_replace('@tn' , $table , $query);
    }
}