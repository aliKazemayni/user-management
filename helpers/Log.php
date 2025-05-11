<?php

namespace Helpers;

class Log
{
    private static function getStyle(string $type = 'default'): string
    {
        return match ($type) {
            'error' => "
                color:#F3F3E0;
                font-size:1rem;
                font-weight: bold;       
                padding:10px;
                background: #BE5B50;
                border-radius: 10px;
            ",
            default => "
                background:#040404;
                color:#FF9F00;
                padding:10px;
                font-size:0.75rem;
                font-weight: bold;
                border-radius: 10px;
                border:1px solid #ccc;
            ",
        };
    }

    public static function print(mixed $value, bool $isDie = false): void
    {
        self::pre($value, 'print_r', $isDie);
    }

    public static function error(mixed $value, bool $isDie = false): void
    {
        self::pre($value, 'print_r', $isDie, 'error');
    }

    public static function dump(mixed $value, bool $isDie = false): void
    {
        self::pre($value, 'var_dump', $isDie);
    }

    private static function pre(mixed $value, string $method, bool $isDie, string $style = 'default'): void
    {
        $finalStyle = self::getStyle($style);
        echo "<pre style='$finalStyle'>";
        $method($value);
        echo "</pre>";
        $isDie && die();
    }

}