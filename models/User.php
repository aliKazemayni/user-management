<?php

namespace Models;

use Core\Database\Model;

class User extends Model{

    #[\Override]
    protected static function table(): string
    {
        return "post";
    }
}
