<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-filter-helper.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-needy-item-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');

    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-needy-item-utils.php');

    $filter = RequestHelper::getParameter(FilterHelper::FILTER_FIELD);

    $needyItems = [];
    if ($filter == FilterHelper::ALL)
    {
        $needyItems = NeedyItemDBUtils::getAllNeedyItems();
    }
    elseif ($filter == FilterHelper::ALL_CHILDS)
    {
        $needyItems = NeedyItemDBUtils::getAllChildsItems();
    }
    elseif ($filter == FilterHelper::URGENTLY_NEED_HELP_CHILDS)
    {
        $needyItems = NeedyItemDBUtils::getUrgentlyNeedHelpChildsItems();
    }
    elseif ($filter == FilterHelper::NEED_HELP_CHILDS)
    {
        $needyItems = NeedyItemDBUtils::getNeedHelpChildsItems();
    }
    elseif ($filter == FilterHelper::HELPED_CHILDS)
    {
        $needyItems = NeedyItemDBUtils::getHelpedChildsItems();
    }
    elseif ($filter == FilterHelper::ALL_ORPHANAGES)
    {
        $needyItems = NeedyItemDBUtils::getAllOrphanagesItems();
    }

    $data = ["needyItems" => $needyItems];
    echo TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/needy-item-info-block.php', $data);