<?php

require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-type.php');
require_once(ABSPATH . WPINC . '/lib/model/needy_settings/class-needy-item-settings.php');
require_once(ABSPATH . WPINC . '/lib/model/child_settings/class-child-settings.php');
require_once(ABSPATH . WPINC . '/lib/model/orphanage_settings/class-orphanage-settings.php');

class NeedyItemSettingsDBUtils
{
    static function isSetShowNeedyItemStat($needyItemId, $needyItemType)
    {
        if ($needyItemType == NeedyType::CHILD)
        {
            $result = self::isSetShowChildStat($needyItemId);
        }
        else
        {
            $result = self::isSetShowOrphanageStat($needyItemId);
        }
        return $result;
    }

    static function isSetShowChildStat($childId)
    {
        global $wpdb;
        $result = $wpdb->get_row(
           "SELECT " .
                ChildSettings::SHOW_STAT_FIELD . " as " . NeedyItemSettings::SHOW_STAT_FIELD . "
            FROM `" . ChildSettings::DB_TABLE_NAME . "`
            WHERE " . ChildSettings::NEEDY_ID_FIELD . " = " . $childId);
        return (empty($result) || is_null($result)) ? false : $result->show_stat;
    }

    static function isChildSettingsNotExist($childId)
    {
        global $wpdb;
        $result = $wpdb->get_row(
            "SELECT " .
            ChildSettings::SHOW_STAT_FIELD . " as " . NeedyItemSettings::SHOW_STAT_FIELD . "
            FROM `" . ChildSettings::DB_TABLE_NAME . "`
            WHERE " . ChildSettings::NEEDY_ID_FIELD . " = " . $childId);
        return (empty($result) || is_null($result));
    }

    static function isSetShowOrphanageStat($orphanageId)
    {
        global $wpdb;
        $result = $wpdb->get_row(
           "SELECT " .
                OrphanageSettings::SHOW_STAT_FIELD . " as " . NeedyItemSettings::SHOW_STAT_FIELD . "
            FROM `" . OrphanageSettings::DB_TABLE_NAME . "`
            WHERE " . OrphanageSettings::NEEDY_ID_FIELD . " = " . $orphanageId);
        return (empty($result) || is_null($result)) ? false : $result->show_stat;
    }

    static function isOrphanageSettingsNotExist($orphanageId)
    {
        global $wpdb;
        $result = $wpdb->get_row(
            "SELECT " .
            OrphanageSettings::SHOW_STAT_FIELD . " as " . NeedyItemSettings::SHOW_STAT_FIELD . "
            FROM `" . OrphanageSettings::DB_TABLE_NAME . "`
            WHERE " . OrphanageSettings::NEEDY_ID_FIELD . " = " . $orphanageId);
        return (empty($result) || is_null($result));
    }

    static function createChildSettings($childId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("INSERT INTO `" . ChildSettings::DB_TABLE_NAME .
                                           "` (" .
                                                ChildSettings::NEEDY_ID_FIELD .
                                           ") VALUES (%d)",
                                                $childId));
    }

    static function createOrphanageSettings($childId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("INSERT INTO `" . OrphanageSettings::DB_TABLE_NAME .
                                           "` (" .
                                                OrphanageSettings::NEEDY_ID_FIELD .
                                           ") VALUES (%d)",
                                                $childId));
    }

    static function updateChildSettings($childId, $childInfo)
    {
        global $wpdb;

        $showStat = $childInfo[ChildSettings::SHOW_STAT_FIELD];
        $addAmount = $childInfo[ChildSettings::ADDITION_AMOUNT];

        $showStat = is_null($showStat) ? 0 : $showStat;
        $isSettingsNotExist = self::isChildSettingsNotExist($childId);
        if ($isSettingsNotExist)
        {
            self::createChildSettings($childId);
        }

        $q = $wpdb->prepare("UPDATE `" . ChildSettings::DB_TABLE_NAME .
            "` SET " .
            ChildSettings::SHOW_STAT_FIELD . " = %d, " .
            ChildSettings::ADDITION_AMOUNT . " = %s " .
            " WHERE " . ChildSettings::NEEDY_ID_FIELD . " = %d",
            $showStat,
            round($addAmount, 2),
            $childId);

        return $wpdb->query($q);
    }

    static function updateOrphanageSettings($orphanageId, $orphanageInfo)
    {
        global $wpdb;

        $showStat = $orphanageInfo[OrphanageSettings::SHOW_STAT_FIELD];
        $addAmount = $orphanageInfo[OrphanageSettings::ADDITION_AMOUNT];

        $showStat = is_null($showStat) ? 0 : $showStat;
        $isSettingsNotExist = self::isOrphanageSettingsNotExist($orphanageId);
        if ($isSettingsNotExist)
        {
            self::createOrphanageSettings($orphanageId);
        }

        return $wpdb->query($wpdb->prepare("UPDATE `" . OrphanageSettings::DB_TABLE_NAME .
                                         "` SET " .
                                              OrphanageSettings::SHOW_STAT_FIELD . " = %d, " .
                                              OrphanageSettings::ADDITION_AMOUNT . " = %s " .
                                          " WHERE " . OrphanageSettings::NEEDY_ID_FIELD . " = %d",
                                              $showStat,
                                              round($addAmount, 2),
                                              $orphanageId));
    }

    public static function getAdditionAmount($needyId, $needyType)
    {
        global $wpdb;

        $needyTable = ($needyType == NeedyType::CHILD) ? ChildSettings::DB_TABLE_NAME : OrphanageSettings::DB_TABLE_NAME;
        $needyIdColumn = ($needyType == NeedyType::CHILD) ? ChildSettings::NEEDY_ID_FIELD : OrphanageSettings::NEEDY_ID_FIELD;

        $result = $wpdb->get_row(
            "SELECT " .
            NeedyItemSettings::ADDITION_AMOUNT . " as " . NeedyItemSettings::ADDITION_AMOUNT . "
            FROM `" . $needyTable . "`
            WHERE " . $needyIdColumn . " = " . $needyId);
        return $result;
    }
}