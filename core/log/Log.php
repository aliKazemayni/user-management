<?php

namespace Core\Log;

class Log extends Logger
{
    #[\Override] static function getFilePath(): string
    {
        return  __DIR__ . '/../storage/logs/app.log';
    }

    #[\Override] static function getStyle(): string
    {
        return "
            background:#040404;
            color:#FF9F00;
            padding:10px;
            font-size:0.75rem;
            font-weight: bold;
            border-radius: 10px;
            border:1px solid #ccc;
        ";          
    }

    public static function print(mixed $value, bool $isDie = false, $saveInFile = false): void
    {
        $saveInFile && static::writeToFile($value, 'info');
        static::pre($value, 'print_r', $isDie);
    }
    
    public static function dump(mixed $value, bool $isDie = false, $saveInFile = false): void
    {
        $saveInFile && static::writeToFile($value, 'info');
        static::pre($value, 'var_dump', $isDie);
    }
}