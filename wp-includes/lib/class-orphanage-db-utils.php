<?php

require_once(ABSPATH . WPINC . '/lib/class-orphanage.php');

class OrphanageDBUtils
{
    const DB_TABLE_NAME = "wp_orphanage";

    static function createOrphanage($orphanageInfo, $imageId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("INSERT INTO `" . self::DB_TABLE_NAME .
            "` (" .
            Orphanage::NAME_FIELD . ", " .
            Orphanage::DESCRIPTION_FIELD . ", " .
            Orphanage::CONTACT_INFO_FIELD . ", " .
            Orphanage::PRIORITY_FIELD . ", " .
            Orphanage::IMAGE_FIELD .
            ") VALUES (%s, %s, %s, %d, %d)",
            $orphanageInfo[Orphanage::NAME_FIELD],
            $orphanageInfo[Orphanage::DESCRIPTION_FIELD],
            $orphanageInfo[Orphanage::CONTACT_INFO_FIELD],
            $orphanageInfo[Orphanage::PRIORITY_FIELD],
            $imageId));
    }

    static function updateOrphanageById($orphanageInfo, $imageId, $orphanageId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("UPDATE `" . self::DB_TABLE_NAME .
            "` SET " .
            Orphanage::NAME_FIELD . " = %s, " .
            Orphanage::DESCRIPTION_FIELD . " = %s, " .
            Orphanage::CONTACT_INFO_FIELD . " = %s, " .
            Orphanage::PRIORITY_FIELD . " = %d, " .
            Orphanage::IMAGE_FIELD . " = %d " .
            " WHERE " . Orphanage::ID_FIELD . " = %d",
            $orphanageInfo[Orphanage::NAME_FIELD],
            $orphanageInfo[Orphanage::DESCRIPTION_FIELD],
            $orphanageInfo[Orphanage::CONTACT_INFO_FIELD],
            $orphanageInfo[Orphanage::PRIORITY_FIELD],
            $imageId,
            $orphanageId));
    }

    static function getOrphanages()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM `" . self::DB_TABLE_NAME . "` ORDER BY priority DESC");
    }

    static function getOrphanageById($orphanageId)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT * FROM `" . self::DB_TABLE_NAME . "` WHERE " . Orphanage::ID_FIELD . " = {$orphanageId}");
    }

    static function deleteOrphanageById($orphanageId)
    {
        global $wpdb;
        return $wpdb->get_row("DELETE FROM `" . self::DB_TABLE_NAME . "` WHERE " . Orphanage::ID_FIELD . " = {$orphanageId}");
    }
}