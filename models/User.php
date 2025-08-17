<?php

namespace Models;

use Core\Database\Database;
use Core\Database\Model;

class User extends Model{

    #[\Override]
    protected static function table(): string
    {
        return "users";
    }

    public static function search(string $q): array
    {
        $sql = "SELECT * FROM @tn WHERE name LIKE :q OR email LIKE :q";
        return Database::query(
            self::queryBuilder($sql),
            ['q' => "%$q%"]
        )->all();
    }
}
