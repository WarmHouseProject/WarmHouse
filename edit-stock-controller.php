<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/validator/class-stock-form-validator.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-image-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-stock-db-utils.php');
    
    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }
    
    $stockInfo = RequestHelper::getStockInfoFromRequest();
    if (StockFormValidator::validateEditStockParameters($stockInfo))
    {
        $stock = StockDBUtils::getStockById($stockInfo[Stock::ID_FIELD]);
        $imageId = $stock->image_id;
        if ($stock && StockFormValidator::validateStockAvatar($stockInfo))
        {
            $image = ImageUtils::createImageFromRequestParameters($stockInfo);
            if ($image)
            {
                ImageUtils::deleteImageById($stock->image_id);
                $imageId = $image->image_id;
            }
        }
        StockDBUtils::updateStockById($stockInfo, $imageId, $stock->stock_id);
    }
    
    wp_redirect(get_site_url() . '/stocks'); exit;