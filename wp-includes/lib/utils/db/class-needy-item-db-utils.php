<?php

require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-item.php');
require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-type.php');
require_once(ABSPATH . WPINC . '/lib/model/child/class-child.php');
require_once(ABSPATH . WPINC . '/lib/model/child/class-child-status.php');
require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-status.php');
require_once(ABSPATH . WPINC . '/lib/model/orphanage/class-orphanage.php');

class NeedyItemDBUtils
{
    static function getAllNeedyItems()
    {
        global $wpdb;
        return $wpdb->get_results(
            "SELECT *
             FROM
             (
               (
                 (
                   SELECT " .
                     Child::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                     Child::NAME_FIELD . " as " . NeedyItem::NAME_FIELD . "," .
                     Child::SHORT_DESCRIPTION_FIELD . " as " . NeedyItem::SHORT_DESCRIPTION_FIELD . "," .
                     Child::LONG_DESCRIPTION_FIELD . " as " . NeedyItem::LONG_DESCRIPTION_FIELD . "," .
                     Child::CONTACT_INFO_FIELD . " as " . NeedyItem::CONTACT_INFO_FIELD . "," .
                     Child::STATUS_FIELD . " as " . NeedyItem::STATUS_FIELD . "," .
                     Child::PRIORITY_FIELD . " as " . NeedyItem::PRIORITY_FIELD . "," .
                     Child::IMAGE_FIELD . " as " . NeedyItem::IMAGE_FIELD . "," .
                     NeedyType::CHILD . " as " . NeedyItem::NEEDY_TYPE . "
                   FROM `" . Child::DB_TABLE_NAME . "`
                 )
                 UNION ALL
                 (
                   SELECT " .
                     Orphanage::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                     Orphanage::NAME_FIELD . " as " . NeedyItem::NAME_FIELD . "," .
                     Orphanage::SHORT_DESCRIPTION_FIELD . " as " . NeedyItem::SHORT_DESCRIPTION_FIELD . "," .
                     Orphanage::LONG_DESCRIPTION_FIELD . " as " . NeedyItem::LONG_DESCRIPTION_FIELD . "," .
                     Orphanage::CONTACT_INFO_FIELD . " as " . NeedyItem::CONTACT_INFO_FIELD . "," .
                     NeedyStatus::DEFAULT_NEEDY_STATUS . " as " . NeedyItem::STATUS_FIELD . "," .
                     Orphanage::PRIORITY_FIELD . " as " . NeedyItem::PRIORITY_FIELD . "," .
                     Orphanage::IMAGE_FIELD . " as " . NeedyItem::IMAGE_FIELD . "," .
                     NeedyType::ORPHANAGE . " as " . NeedyItem::NEEDY_TYPE . "
                   FROM `" . Orphanage::DB_TABLE_NAME . "`
                 )
               ) as t
             )
             ORDER BY " . NeedyItem::STATUS_FIELD . " DESC, " . NeedyItem::NEEDY_TYPE . " DESC, " . NeedyItem::PRIORITY_FIELD . " DESC");
    }

    static function getAllChildsItems()
    {
        global $wpdb;
        return $wpdb->get_results(
            "SELECT *
             FROM
             (
                 (
                   SELECT " .
                     Child::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                     Child::NAME_FIELD . " as " . NeedyItem::NAME_FIELD . "," .
                     Child::SHORT_DESCRIPTION_FIELD . " as " . NeedyItem::SHORT_DESCRIPTION_FIELD . "," .
                     Child::LONG_DESCRIPTION_FIELD . " as " . NeedyItem::LONG_DESCRIPTION_FIELD . "," .
                     Child::CONTACT_INFO_FIELD . " as " . NeedyItem::CONTACT_INFO_FIELD . "," .
                     Child::STATUS_FIELD . " as " . NeedyItem::STATUS_FIELD . "," .
                     Child::PRIORITY_FIELD . " as " . NeedyItem::PRIORITY_FIELD . "," .
                     Child::IMAGE_FIELD . " as " . NeedyItem::IMAGE_FIELD . "," .
                     NeedyType::CHILD . " as " . NeedyItem::NEEDY_TYPE . "
                   FROM `" . Child::DB_TABLE_NAME . "`
                 ) as t
             )
             ORDER BY " . NeedyItem::STATUS_FIELD . " DESC, " . NeedyItem::PRIORITY_FIELD . " DESC");
    }

    static function getUrgentlyNeedHelpChildsItems()
    {
        $urgentlyNeedHelpChildStatuses = implode(',', ChildStatus::getUrgentlyNeedHelpNeedyStatuses());
        return self::getChildsItemsByStatuses($urgentlyNeedHelpChildStatuses);
    }

    static function getNeedHelpChildsItems()
    {
        $needHelpChildStatuses = implode(',', ChildStatus::getNeedHelpNeedyStatuses());
        return self::getChildsItemsByStatuses($needHelpChildStatuses);
    }

    static function getHelpedChildsItems()
    {
        $helpedChildStatuses = implode(',', ChildStatus::getHelpedNeedyStatuses());
        return self::getChildsItemsByStatuses($helpedChildStatuses);
    }

    static function getChildsItemsByStatuses($statuses)
    {
        global $wpdb;
        return $wpdb->get_results(
            "SELECT *
             FROM
             (
                 (
                   SELECT " .
            Child::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
            Child::NAME_FIELD . " as " . NeedyItem::NAME_FIELD . "," .
            Child::SHORT_DESCRIPTION_FIELD . " as " . NeedyItem::SHORT_DESCRIPTION_FIELD . "," .
            Child::LONG_DESCRIPTION_FIELD . " as " . NeedyItem::LONG_DESCRIPTION_FIELD . "," .
            Child::CONTACT_INFO_FIELD . " as " . NeedyItem::CONTACT_INFO_FIELD . "," .
            Child::STATUS_FIELD . " as " . NeedyItem::STATUS_FIELD . "," .
            Child::PRIORITY_FIELD . " as " . NeedyItem::PRIORITY_FIELD . "," .
            Child::IMAGE_FIELD . " as " . NeedyItem::IMAGE_FIELD . "," .
            NeedyType::CHILD . " as " . NeedyItem::NEEDY_TYPE . "
                   FROM `" . Child::DB_TABLE_NAME . "`
                 ) as t
             )
             WHERE " . Child::STATUS_FIELD . " IN ({$statuses})
             ORDER BY " . NeedyItem::STATUS_FIELD . " DESC, " . NeedyItem::PRIORITY_FIELD . " DESC");
    }

    static function getAllOrphanagesItems()
    {
        global $wpdb;
        return $wpdb->get_results(
            "SELECT *
             FROM
             (
                 (
                   SELECT " .
                     Orphanage::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                     Orphanage::NAME_FIELD . " as " . NeedyItem::NAME_FIELD . "," .
                      Orphanage::SHORT_DESCRIPTION_FIELD . " as " . NeedyItem::SHORT_DESCRIPTION_FIELD . "," .
                     Orphanage::LONG_DESCRIPTION_FIELD . " as " . NeedyItem::LONG_DESCRIPTION_FIELD . "," .
                     Orphanage::CONTACT_INFO_FIELD . " as " . NeedyItem::CONTACT_INFO_FIELD . "," .
                     NeedyStatus::DEFAULT_NEEDY_STATUS . " as " . NeedyItem::STATUS_FIELD . "," .
                     Orphanage::PRIORITY_FIELD . " as " . NeedyItem::PRIORITY_FIELD . "," .
                     Orphanage::IMAGE_FIELD . " as " . NeedyItem::IMAGE_FIELD . "," .
                     NeedyType::ORPHANAGE . " as " . NeedyItem::NEEDY_TYPE . "
                   FROM `" . Orphanage::DB_TABLE_NAME . "`
                 ) as t
             )
             ORDER BY " . NeedyItem::STATUS_FIELD . " DESC, " . NeedyItem::NEEDY_TYPE . " DESC, " . NeedyItem::PRIORITY_FIELD . " DESC");
    }
}