<?php

namespace Core\Log;

class Error extends Logger
{

    #[\Override] static function getFilePath(): string
    {
        return  __DIR__ . '/../storage/logs/error.log';
    }

    #[\Override] static function getStyle(): string
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

    public static function show(mixed $value, bool $isDie = false, $saveInFile = false): void
    {
        $saveInFile && static::writeToFile($value, 'error');
        static::pre($value, 'print_r', $isDie, 'error');
    }

}