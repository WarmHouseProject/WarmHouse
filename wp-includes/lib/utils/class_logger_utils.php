<?php

class LoggerUtils
{
    /**
     * Writes message to log.
     *
     * @param string $logFile path to log file
     * @param string $msg
     */
    public static function log($logFile, $msg)
    {
        $logPath = get_home_path() . DIRECTORY_SEPARATOR . log;
        $f = @fopen($logPath . DIRECTORY_SEPARATOR . $logFile, "a");
        if (!$f)
        {
            return;
        }

        fprintf($f, "[%s] %s\n", date("Y-m-d H:i:s"), $msg);
        fclose($f);
    }
}