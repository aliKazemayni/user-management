<?php

namespace Core\Log;

class Error extends Logger
{
    #[\Override]
    protected static function getFilePath(): string
    {
        return dirname(__DIR__, 2) . '/storage/logs/error.log';
    }

    #[\Override]
    protected static function getStyle(): string
    {
        return "
                color:#F3F3E0;
                font-size:1rem;
                font-weight: bold;       
                padding:10px;
                background: #BE5B50;
                border-radius: 10px;
        ";
    }

    public static function show(mixed $value, bool $isDie = false, bool $saveInFile = false): void
    {
        $saveInFile && static::writeToFile($value, 'error');
        static::pre($value, 'print_r', $isDie, 'error');
    }

    public static function database(mixed $value, bool $isDie = false, bool $saveInFile = false): void
    {
        $saveInFile && static::writeToFile($value, 'error' , dirname(__DIR__, 2) . '/storage/logs/database.log');
        static::pre($value, 'print_r', $isDie, 'error');
    }

}