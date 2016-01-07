<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-stock-filter-helper.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-stock-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');

    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-stock-utils.php');

    $filter = RequestHelper::getParameter(StockFilterHelper::FILTER_FIELD);

    $stocks = [];
    if ($filter == StockFilterHelper::ACTIVE)
    {
        $stocks = StockDBUtils::getActiveStocks();
    }
    elseif ($filter == StockFilterHelper::INACTIVE)
    {
        $stocks = StockDBUtils::getInactiveStocks();
    }

    $data = ["stocks" => $stocks];
    echo TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/stock-info-block.php', $data);