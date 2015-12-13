<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-stock-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $stockId = RequestHelper::getParameter("stock_id");
    $stock = null;

    if ($stockId)
    {
        $stock = StockDBUtils::getStockById($stockId);
    }

    $data = ["stock" => $stock];
    TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/stock-form.php', $data);