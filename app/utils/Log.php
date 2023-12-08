<?php

namespace App\utils;

use App\utils\View;

class Log extends View
{
    // use View;
    
    public static function log(string $message, string $file, int $line, int|string $code)
    {
        $currentDate = date("Y-m-d");
        $currentDateTime = date("Y-m-d H:i:s");

        $logFile = fopen("log/$currentDate.txt","a+");
        fwrite($logFile, "[An error was caught $currentDateTime]\n\nMesage: $message\nFile: $file\nLine: $line\nCode: $code\n\n");
        fwrite($logFile,"---------------------------------------------------------------\n");
        fclose($logFile);

        self::showLog($message, $file, $line, $code);
    }

    private static function showLog(string $message, string $file, int $line, int|string $code)
    {
        echo self::render("layouts.error", [
            "errorCode" => $code,
            "errorMessage" => $message,
            "errorFile" => $file,
            "errorLine" => $line,
        ]);
    }
}
