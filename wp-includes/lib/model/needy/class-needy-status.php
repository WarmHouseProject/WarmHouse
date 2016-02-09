<?php

class NeedyStatus
{
    const HELPED             = 0;
    const NEED_HELP          = 1;
    const URGENTLY_NEED_HELP = 2;

    const DEFAULT_NEEDY_STATUS = self::NEED_HELP;

    static function getNeedyClassByStatuses($status)
    {
        $result = "need-help";
        $classes = [
            self::HELPED    => "helped",
            self::NEED_HELP => "need-help",
            self::URGENTLY_NEED_HELP => "urgently-need-help",
        ];
        if (array_key_exists($status, $classes))
        {
            $result = $classes[$status];
        }
        return $result;
    }

    static function getNeedyStatuses()
    {
        return [
            self::HELPED ,
            self::NEED_HELP,
            self::URGENTLY_NEED_HELP,
        ];
    }

    static function getUrgentlyNeedHelpNeedyStatus()
    {
        return [
            self::URGENTLY_NEED_HELP,
        ];
    }

    static function getNeedHelpNeedyStatuses()
    {
        return [
            self::NEED_HELP,
            self::URGENTLY_NEED_HELP,
        ];
    }

    static function getNeedHelpNeedyStatus()
    {
        return [
            self::NEED_HELP,
        ];
    }

    static function getHelpedNeedyStatus()
    {
        return [
            self::HELPED,
        ];
    }

    static function getNeedyStatusesText()
    {
        return [
            self::HELPED => 'Помогли',
            self::NEED_HELP => "Нужна помощь",
            self::URGENTLY_NEED_HELP => "Срочно нужна помощь",
        ];
    }
}