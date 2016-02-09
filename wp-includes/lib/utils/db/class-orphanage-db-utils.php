<?php

require_once(ABSPATH . WPINC . '/lib/model/orphanage/class-orphanage.php');

class OrphanageDBUtils
{
    static function createOrphanage($orphanageInfo, $imageId)
    {
        global $wpdb;
        $wpdb->query($wpdb->prepare("INSERT INTO `" . Orphanage::DB_TABLE_NAME .
            "` (" .
            Orphanage::NAME_FIELD . ", " .
            Orphanage::SHORT_DESCRIPTION_FIELD . ", " .
            Orphanage::LONG_DESCRIPTION_FIELD . ", " .
            Orphanage::PURPOSE_FIELD . ", " .
            Orphanage::CONTACT_INFO_FIELD . ", " .
            Orphanage::PRIORITY_FIELD . ", " .
            Orphanage::IMAGE_FIELD .
            ") VALUES (%s, %s, %s, %s, %s, %d, %d)",
            $orphanageInfo[Orphanage::NAME_FIELD],
            $orphanageInfo[Orphanage::SHORT_DESCRIPTION_FIELD],
            $orphanageInfo[Orphanage::LONG_DESCRIPTION_FIELD],
            $orphanageInfo[Orphanage::PURPOSE_FIELD],
            $orphanageInfo[Orphanage::CONTACT_INFO_FIELD],
            $orphanageInfo[Orphanage::PRIORITY_FIELD],
            $imageId));
        return $wpdb->insert_id;
    }

    static function updateOrphanageById($orphanageInfo, $imageId, $orphanageId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("UPDATE `" . Orphanage::DB_TABLE_NAME .
            "` SET " .
            Orphanage::NAME_FIELD . " = %s, " .
            Orphanage::SHORT_DESCRIPTION_FIELD . " = %s, " .
            Orphanage::LONG_DESCRIPTION_FIELD . " = %s, " .
            Orphanage::PURPOSE_FIELD . " = %s, " .
            Orphanage::CONTACT_INFO_FIELD . " = %s, " .
            Orphanage::PRIORITY_FIELD . " = %d, " .
            Orphanage::IMAGE_FIELD . " = %d " .
            " WHERE " . Orphanage::ID_FIELD . " = %d",
            $orphanageInfo[Orphanage::NAME_FIELD],
            $orphanageInfo[Orphanage::SHORT_DESCRIPTION_FIELD],
            $orphanageInfo[Orphanage::LONG_DESCRIPTION_FIELD],
            $orphanageInfo[Orphanage::PURPOSE_FIELD],
            $orphanageInfo[Orphanage::CONTACT_INFO_FIELD],
            $orphanageInfo[Orphanage::PRIORITY_FIELD],
            $imageId,
            $orphanageId));
    }

    static function getOrphanageById($orphanageId)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT * FROM `" . Orphanage::DB_TABLE_NAME . "` WHERE " . Orphanage::ID_FIELD . " = {$orphanageId}");
    }

    static function deleteOrphanageById($orphanageId)
    {
        global $wpdb;
        return $wpdb->get_row("DELETE FROM `" . Orphanage::DB_TABLE_NAME . "` WHERE " . Orphanage::ID_FIELD . " = {$orphanageId}");
    }
}