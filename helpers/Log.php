<?php

namespace Helpers;

class Log
{
    private static string $logPath = __DIR__ . '/../storage/logs/app.log';

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

    public static function print(mixed $value, bool $isDie = false, $saveInFile = false): void
    {
        self::pre($value, 'print_r', $isDie);
        $saveInFile && self::writeToFile($value, 'info');
    }

    public static function error(mixed $value, bool $isDie = false, $saveInFile = false): void
    {
        self::pre($value, 'print_r', $isDie, 'error');
        $saveInFile && self::writeToFile($value, 'error');
    }

    public static function dump(mixed $value, bool $isDie = false, $saveInFile = false): void
    {
        self::pre($value, 'var_dump', $isDie);
        $saveInFile && self::writeToFile($value, 'info');
    }

    private static function pre(mixed $value, string $method, bool $isDie, string $style = 'default'): void
    {
        $finalStyle = self::getStyle($style);
        echo "<pre style='$finalStyle'>";
        $method($value);
        echo "</pre>";
        $isDie && die();
    }

    private static function writeToFile(mixed $data, string $level): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $formatted = is_string($data) ? $data : var_export($data, true);
        $logEntry = "[$timestamp] [$level] $formatted" . PHP_EOL;

        $logDir = dirname(self::$logPath);

        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        file_put_contents(self::$logPath, $logEntry, FILE_APPEND);
    }

}