<?php

namespace Models;

use Core\Database\Model;

class Post extends Model{

    #[\Override]
    protected static function table(): string
    {
        return "post";
    }
}
