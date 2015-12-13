<?php

require_once(ABSPATH . WPINC . '/lib/model/stock/class-stock.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-stock-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/class-image-utils.php');

class StockUtils
{
    static function deleteStockById($stockId)
    {
        $stock = StockDBUtils::getStockById($stockId);
        ImageUtils::deleteImageById($stock->image_id);
        StockDBUtils::deleteStockById($stockId);
    }
}