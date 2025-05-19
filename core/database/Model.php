<?php

namespace Core\Database;

abstract class Model
{
    abstract protected static function table(): string;

    public static function all(): array
    {
        return Database::query(
            self::queryBuilder("SELECT * FROM @tn")
        )->all();
    }

    public static function find(int $id): array
    {
        return Database::query(
            self::queryBuilder("SELECT * FROM @tn WHERE id = $id")
        )->one();
    }

    public static function create(array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        return Database::query(
                self::queryBuilder("INSERT INTO  @tn  ($columns) VALUES ($placeholders)"),
                $data
            )->count() > 0;
    }

    public static function delete(int $id): bool
    {
        return Database::query(
            self::queryBuilder("DELETE FROM @tn WHERE id = $id"),
        )->count() > 0;
    }

    public static function update(int $id, array $data): bool
    {
        $fields = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $data['id'] = $id;

        return Database::query(
                self::queryBuilder("UPDATE @tn SET $fields WHERE id = :id"),
                $data
            )->count() > 0;
    }

    public static function where(string $field, mixed $value): array
    {
        return Database::query(
            self::queryBuilder("SELECT * FROM @tn WHERE $field = :value"),
            ['value' => $value]
        )->all();
    }

    private static function queryBuilder(string $query): string
    {
        $table = static::table();
        return str_replace('@tn', $table, $query);
    }
}