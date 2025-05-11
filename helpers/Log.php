<?php

namespace Helpers;

class Log
{
    private static string $style = "background:#040404; color:#FF9F00; padding:10px; border:1px solid #ccc;";

    public static function print(mixed $value, bool $isDie = false): void
    {
        self::pre($value,'print_r',$isDie);
    }

    public static function dump(mixed $value, bool $isDie = false): void
    {
        self::pre($value,'var_dump',$isDie);
    }

    private static function pre(mixed $value, string $method, bool $isDie): void
    {
        echo "<pre style='".self::$style."'>";
        $method($value);
        echo "</pre>";
        $isDie && die();
    }
}