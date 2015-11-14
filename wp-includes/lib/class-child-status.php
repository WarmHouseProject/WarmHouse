<?php

class ChildStatus
{
    const HELPED             = 0;
    const NEED_HELP          = 1;
    const URGENTLY_NEED_HELP = 2;

    const DEFAULT_CHILD_STATUS = self::NEED_HELP;

    static function getChildStatuses()
    {
        return [
            self::HELPED ,
            self::NEED_HELP,
            self::URGENTLY_NEED_HELP,
        ];
    }

    static function getNeedHelpChildStatuses()
    {
        return [
            self::NEED_HELP,
            self::URGENTLY_NEED_HELP,
        ];
    }

    static function getHelpedChildStatuses()
    {
        return [
            self::HELPED,
        ];
    }

    static function getChildStatusesText()
    {
        return [
            self::HELPED => 'Помогли',
            self::NEED_HELP => "Нужна помощь",
            self::URGENTLY_NEED_HELP => "Срочно нужна помощь",
        ];
    }
}