<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/class-stock-form-validator.php');
    require_once(ABSPATH . WPINC . '/lib/class-stock-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $stockInfo = RequestHelper::getStockInfoFromRequest();
    if (StockFormValidator::validateStockId($stockInfo))
    {
        StockUtils::deleteStockById($stockInfo[Stock::ID_FIELD]);
    }

    wp_redirect(get_site_url() . '/stocks'); exit;