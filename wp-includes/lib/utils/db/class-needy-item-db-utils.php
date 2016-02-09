<?php

require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-item.php');
require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-type.php');
require_once(ABSPATH . WPINC . '/lib/model/child/class-child.php');
require_once(ABSPATH . WPINC . '/lib/model/child/class-child-status.php');
require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-status.php');
require_once(ABSPATH . WPINC . '/lib/model/orphanage/class-orphanage.php');

class NeedyItemDBUtils
{
    const ROWS_PER_PAGE = 16;
    static function getAllNeedyItemsByStatuses($page = 0, $statuses = [])
    {
        global $wpdb;
        $sql = "SELECT *
                FROM
                (
                  (
                    (
                      SELECT " .
                           Child::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                           Child::NAME_FIELD . " as " . NeedyItem::NAME_FIELD . "," .
                           Child::SHORT_DESCRIPTION_FIELD . " as " . NeedyItem::SHORT_DESCRIPTION_FIELD . "," .
                           Child::LONG_DESCRIPTION_FIELD . " as " . NeedyItem::LONG_DESCRIPTION_FIELD . "," .
                           Child::PURPOSE_FIELD . " as " . NeedyItem::PURPOSE_FIELD . "," .
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
                           Orphanage::PURPOSE_FIELD . " as " . NeedyItem::PURPOSE_FIELD . "," .
                           Orphanage::CONTACT_INFO_FIELD . " as " . NeedyItem::CONTACT_INFO_FIELD . "," .
                           NeedyStatus::DEFAULT_NEEDY_STATUS . " as " . NeedyItem::STATUS_FIELD . "," .
                           Orphanage::PRIORITY_FIELD . " as " . NeedyItem::PRIORITY_FIELD . "," .
                           Orphanage::IMAGE_FIELD . " as " . NeedyItem::IMAGE_FIELD . "," .
                           NeedyType::ORPHANAGE . " as " . NeedyItem::NEEDY_TYPE . "
                      FROM `" . Orphanage::DB_TABLE_NAME . "`
                    )
                  ) as t
                )";
            if (!empty($statuses))
            {
                $sql .= "WHERE t." . NeedyItem::STATUS_FIELD . " IN (" . implode(',', $statuses) . ")";
            }
            $sql .= "ORDER BY " . NeedyItem::STATUS_FIELD . " DESC, " . NeedyItem::NEEDY_TYPE . " DESC, " . NeedyItem::PRIORITY_FIELD . " DESC
                     LIMIT " . $page * self::ROWS_PER_PAGE . ", " . self::ROWS_PER_PAGE;
        return $wpdb->get_results($sql);
    }

    static function getAllNeedyItemsByStatusesCountPages($statuses = [])
    {
        global $wpdb;
        $sql = "SELECT COUNT(*) as count
                 FROM
                 (
                   (
                     (
                       SELECT " .
                         Child::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                         Child::STATUS_FIELD . " as " . NeedyItem::STATUS_FIELD . "
                       FROM `" . Child::DB_TABLE_NAME . "`
                     )
                     UNION ALL
                     (
                       SELECT " .
                         Orphanage::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                         NeedyStatus::DEFAULT_NEEDY_STATUS . " as " . NeedyItem::STATUS_FIELD ."
                       FROM `" . Orphanage::DB_TABLE_NAME . "`
                     )
                   ) as t
                 )";
        if (!empty($statuses))
        {
            $sql .= "WHERE t." . NeedyItem::STATUS_FIELD . " IN (" . implode(',', $statuses) . ")";
        }
        $result = $wpdb->get_row($sql);
        return intval($result->count / self::ROWS_PER_PAGE);
    }

    static function getAllChildsItems($page = 0)
    {
        global $wpdb;
        return $wpdb->get_results(
            "SELECT " .
                Child::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                Child::NAME_FIELD . " as " . NeedyItem::NAME_FIELD . "," .
                Child::SHORT_DESCRIPTION_FIELD . " as " . NeedyItem::SHORT_DESCRIPTION_FIELD . "," .
                Child::LONG_DESCRIPTION_FIELD . " as " . NeedyItem::LONG_DESCRIPTION_FIELD . "," .
                Child::PURPOSE_FIELD . " as " . NeedyItem::PURPOSE_FIELD . "," .
                Child::CONTACT_INFO_FIELD . " as " . NeedyItem::CONTACT_INFO_FIELD . "," .
                Child::STATUS_FIELD . " as " . NeedyItem::STATUS_FIELD . "," .
                Child::PRIORITY_FIELD . " as " . NeedyItem::PRIORITY_FIELD . "," .
                Child::IMAGE_FIELD . " as " . NeedyItem::IMAGE_FIELD . "," .
                NeedyType::CHILD . " as " . NeedyItem::NEEDY_TYPE . "
            FROM `" . Child::DB_TABLE_NAME . "`
            ORDER BY " . NeedyItem::STATUS_FIELD . " DESC, " . NeedyItem::PRIORITY_FIELD . " DESC
            LIMIT " . $page * self::ROWS_PER_PAGE . ", " . self::ROWS_PER_PAGE);
    }

    static function getAllChildsItemsCountPages()
    {
        global $wpdb;
        $result = $wpdb->get_results(
            "SELECT COUNT(*) as count
             FROM `" . Child::DB_TABLE_NAME . "`");
        return intval($result[0]->count / self::ROWS_PER_PAGE);
    }

    static function getUrgentlyNeedHelpChildsItems($page = 0)
    {
        $urgentlyNeedHelpChildStatuses = implode(',', ChildStatus::getUrgentlyNeedHelpNeedyStatus());
        return self::getChildsItemsByStatuses($urgentlyNeedHelpChildStatuses, $page);
    }

    static function getNeedHelpChildsItems($page = 0)
    {
        $needHelpChildStatuses = implode(',', ChildStatus::getNeedHelpNeedyStatus());
        return self::getChildsItemsByStatuses($needHelpChildStatuses, $page);
    }

    static function getHelpedChildsItems($page = 0)
    {
        $helpedChildStatuses = implode(',', ChildStatus::getHelpedNeedyStatus());
        return self::getChildsItemsByStatuses($helpedChildStatuses, $page);
    }

    static function getUrgentlyNeedHelpChildsItemsCountPages()
    {
        $urgentlyNeedHelpChildStatuses = implode(',', ChildStatus::getUrgentlyNeedHelpNeedyStatus());
        return self::getChildsItemsByStatusesCountPages($urgentlyNeedHelpChildStatuses);
    }

    static function getNeedHelpChildsItemsCountPages()
    {
        $needHelpChildStatuses = implode(',', ChildStatus::getNeedHelpNeedyStatus());
        return self::getChildsItemsByStatusesCountPages($needHelpChildStatuses);
    }

    static function getHelpedChildsItemsCountPages()
    {
        $helpedChildStatuses = implode(',', ChildStatus::getHelpedNeedyStatus());
        return self::getChildsItemsByStatusesCountPages($helpedChildStatuses);
    }

    static function getChildsItemsByStatuses($statuses, $page = 0)
    {
        global $wpdb;
        return $wpdb->get_results(
            "SELECT " .
                Child::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                Child::NAME_FIELD . " as " . NeedyItem::NAME_FIELD . "," .
                Child::SHORT_DESCRIPTION_FIELD . " as " . NeedyItem::SHORT_DESCRIPTION_FIELD . "," .
                Child::LONG_DESCRIPTION_FIELD . " as " . NeedyItem::LONG_DESCRIPTION_FIELD . "," .
                Child::PURPOSE_FIELD . " as " . NeedyItem::PURPOSE_FIELD . "," .
                Child::CONTACT_INFO_FIELD . " as " . NeedyItem::CONTACT_INFO_FIELD . "," .
                Child::STATUS_FIELD . " as " . NeedyItem::STATUS_FIELD . "," .
                Child::PRIORITY_FIELD . " as " . NeedyItem::PRIORITY_FIELD . "," .
                Child::IMAGE_FIELD . " as " . NeedyItem::IMAGE_FIELD . "," .
                NeedyType::CHILD . " as " . NeedyItem::NEEDY_TYPE . "
             FROM `" . Child::DB_TABLE_NAME . "`
             WHERE " . Child::STATUS_FIELD . " IN ({$statuses})
             ORDER BY " . NeedyItem::STATUS_FIELD . " DESC, " . NeedyItem::PRIORITY_FIELD . " DESC
             LIMIT " . $page * self::ROWS_PER_PAGE . ", " . self::ROWS_PER_PAGE);
    }

    static function getChildsItemsByStatusesCountPages($statuses)
    {
        global $wpdb;
        $result = $wpdb->get_results(
            "SELECT COUNT(*) as count
             FROM `" . Child::DB_TABLE_NAME . "`
             WHERE " . Child::STATUS_FIELD . " IN ({$statuses})");
        return intval($result[0]->count / self::ROWS_PER_PAGE);
    }

    static function getAllOrphanagesItems($page = 0)
    {
        global $wpdb;
        return $wpdb->get_results(
            "SELECT " .
                Orphanage::ID_FIELD . " as " . NeedyItem::ID_FIELD . "," .
                Orphanage::NAME_FIELD . " as " . NeedyItem::NAME_FIELD . "," .
                Orphanage::SHORT_DESCRIPTION_FIELD . " as " . NeedyItem::SHORT_DESCRIPTION_FIELD . "," .
                Orphanage::LONG_DESCRIPTION_FIELD . " as " . NeedyItem::LONG_DESCRIPTION_FIELD . "," .
                Orphanage::PURPOSE_FIELD . " as " . NeedyItem::PURPOSE_FIELD . "," .
                Orphanage::CONTACT_INFO_FIELD . " as " . NeedyItem::CONTACT_INFO_FIELD . "," .
                NeedyStatus::DEFAULT_NEEDY_STATUS . " as " . NeedyItem::STATUS_FIELD . "," .
                Orphanage::PRIORITY_FIELD . " as " . NeedyItem::PRIORITY_FIELD . "," .
                Orphanage::IMAGE_FIELD . " as " . NeedyItem::IMAGE_FIELD . "," .
                NeedyType::ORPHANAGE . " as " . NeedyItem::NEEDY_TYPE . "
             FROM `" . Orphanage::DB_TABLE_NAME . "`
             ORDER BY " . NeedyItem::STATUS_FIELD . " DESC, " . NeedyItem::NEEDY_TYPE . " DESC, " . NeedyItem::PRIORITY_FIELD . " DESC
             LIMIT " . $page * self::ROWS_PER_PAGE . ", " . self::ROWS_PER_PAGE);
    }

    static function getAllOrphanagesItemsCountPages()
    {
        global $wpdb;
        $result = $wpdb->get_results(
            "SELECT COUNT(*) as count
             FROM `" . Orphanage::DB_TABLE_NAME . "`");
        return intval($result[0]->count / self::ROWS_PER_PAGE);
    }
}