<?php

require_once(ABSPATH . WPINC . '/lib/class-child.php');
require_once(ABSPATH . WPINC . '/lib/class-child-status.php');

class ChildDBUtils
{
    const DB_TABLE_NAME      = "wp_child";

    static function createChild($userInfo, $imageId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("INSERT INTO `" . self::DB_TABLE_NAME .
                                           "` (" .
                                                    Child::NAME_FIELD . ", " .
                                                    Child::SHORT_DESCRIPTION_FIELD . ", " .
                                                    Child::LONG_DESCRIPTION_FIELD . ", " .
                                                    Child::CONTACT_INFO_FIELD . ", " .
                                                    Child::STATUS_FIELD . ", " .
                                                    Child::PRIORITY_FIELD . ", " .
                                                    Child::IMAGE_FIELD .
                                             ") VALUES (%s, %s, %s, %s, %d, %d, %d)",
                                                    $userInfo[Child::NAME_FIELD],
                                                    $userInfo[Child::SHORT_DESCRIPTION_FIELD],
                                                    $userInfo[Child::LONG_DESCRIPTION_FIELD],
                                                    $userInfo[Child::CONTACT_INFO_FIELD],
                                                    $userInfo[Child::STATUS_FIELD],
                                                    $userInfo[Child::PRIORITY_FIELD],
                                                    $imageId));
    }

    static function updateChildById($userInfo, $imageId, $childId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("UPDATE `" . self::DB_TABLE_NAME .
            "` SET " .
            Child::NAME_FIELD . " = %s, " .
            Child::SHORT_DESCRIPTION_FIELD . " = %s, " .
            Child::LONG_DESCRIPTION_FIELD . " = %s, " .
            Child::CONTACT_INFO_FIELD . " = %s, " .
            Child::STATUS_FIELD . " = %d, " .
            Child::PRIORITY_FIELD . " = %d, " .
            Child::IMAGE_FIELD . " = %d " .
            " WHERE " . Child::ID_FIELD . " = %d",
            $userInfo[Child::NAME_FIELD],
            $userInfo[Child::SHORT_DESCRIPTION_FIELD],
            $userInfo[Child::LONG_DESCRIPTION_FIELD],
            $userInfo[Child::CONTACT_INFO_FIELD],
            $userInfo[Child::STATUS_FIELD],
            $userInfo[Child::PRIORITY_FIELD],
            $imageId,
            $childId));
    }

    static function getNeedHelpChilds()
    {
        global $wpdb;
        $needHelpChildStatuses = implode(',', ChildStatus::getNeedHelpChildStatuses());
        return $wpdb->get_results("SELECT * FROM `" . self::DB_TABLE_NAME .
                                "` WHERE " . Child::STATUS_FIELD . " IN ({$needHelpChildStatuses}) ORDER BY status DESC, priority DESC");
    }

    static function getHelpedChilds()
    {
        global $wpdb;
        $needHelpChildStatuses = implode(',', ChildStatus::getHelpedChildStatuses());
        return $wpdb->get_results("SELECT * FROM `" . self::DB_TABLE_NAME .
                                "` WHERE " . Child::STATUS_FIELD . " IN ({$needHelpChildStatuses}) ORDER BY status DESC, priority DESC");
    }

    static function getChildById($childId)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT * FROM `" . self::DB_TABLE_NAME . "` WHERE " . Child::ID_FIELD . " = {$childId}");
    }

    static function deleteChildById($childId)
    {
        global $wpdb;
        return $wpdb->get_row("DELETE FROM `" . self::DB_TABLE_NAME . "` WHERE " . Child::ID_FIELD . " = {$childId}");
    }
}