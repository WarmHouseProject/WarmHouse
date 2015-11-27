<?php

require_once(ABSPATH . WPINC . '/lib/class-stock.php');

class StockDBUtils
{
    const DB_TABLE_NAME = "wp_stock";

    static function createStock($stockInfo, $imageId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("INSERT INTO `" . self::DB_TABLE_NAME .
            "` (" .
            Stock::NAME_FIELD . ", " .
            Stock::DESCRIPTION_FIELD . ", " .
            Stock::PRIORITY_FIELD . ", " .
            Stock::IMAGE_FIELD .
            ") VALUES (%s, %s, %d, %d)",
            $stockInfo[Stock::NAME_FIELD],
            $stockInfo[Stock::DESCRIPTION_FIELD],
            $stockInfo[Stock::PRIORITY_FIELD],
            $imageId));
    }

    static function updateStockById($stockInfo, $imageId, $stockId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("UPDATE `" . self::DB_TABLE_NAME .
            "` SET " .
            Stock::NAME_FIELD . " = %s, " .
            Stock::DESCRIPTION_FIELD . " = %s, " .
            Stock::PRIORITY_FIELD . " = %d, " .
            Stock::IMAGE_FIELD . " = %d " .
            " WHERE " . Stock::ID_FIELD . " = %d",
            $stockInfo[Stock::NAME_FIELD],
            $stockInfo[Stock::DESCRIPTION_FIELD],
            $stockInfo[Stock::PRIORITY_FIELD],
            $imageId,
            $stockId));
    }

    static function getStocks()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM `" . self::DB_TABLE_NAME . "` ORDER BY priority DESC");
    }

    static function getStockById($stockId)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT * FROM `" . self::DB_TABLE_NAME . "` WHERE " . Stock::ID_FIELD . " = {$stockId}");
    }

    static function deleteStockById($stockId)
    {
        global $wpdb;
        return $wpdb->get_row("DELETE FROM `" . self::DB_TABLE_NAME . "` WHERE " . Stock::ID_FIELD . " = {$stockId}");
    }
}