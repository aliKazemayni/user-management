<?php

namespace Core\Log;

abstract class Logger
{
    abstract static function getFilePath() : string;
    abstract static function getStyle() : string;

    protected static function pre(mixed $value, string $method, bool $isDie, string $style = 'default'): void
    {
        $finalStyle = static::getStyle($style);
        echo "<pre style='$finalStyle'>";
        $method($value);
        echo "</pre>";
        $isDie && die();
    }

    protected static function writeToFile(mixed $data, string $level): void
    {
        $logPath = static::getFilePath();
        $timestamp = date('Y-m-d H:i:s');
        $formatted = is_string($data) ? $data : var_export($data, true);
        $logEntry = "[$timestamp] [$level] $formatted" . PHP_EOL;

        $logDir = dirname($logPath);

        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        file_put_contents($logPath, $logEntry, FILE_APPEND);
    }
}