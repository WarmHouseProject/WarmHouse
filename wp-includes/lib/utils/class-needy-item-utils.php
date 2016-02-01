<?php

require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-item.php');

class NeedyItemUtils
{
    static function isItemSupportStatus($needyItem)
    {
        return isset($needyItem->status);
    }

    static function storedTextToHTML($text)
    {
        return nl2br($text);
    }
}