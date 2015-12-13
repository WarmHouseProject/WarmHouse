<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/validator/class-stock-form-validator.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-stock-utils.php');

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