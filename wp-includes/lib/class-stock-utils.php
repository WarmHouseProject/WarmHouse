<?php

require_once( ABSPATH . WPINC . '/lib/class-stock.php' );
require_once(ABSPATH . WPINC . '/lib/class-stock-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/class-image-utils.php');

class StockUtils
{
    static function deleteStockById($stockId)
    {
        $stock = StockDBUtils::getStockById($stockId);
        ImageUtils::deleteImageById($stock->image_id);
        StockDBUtils::deleteStockById($stockId);
    }
}