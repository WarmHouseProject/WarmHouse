<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-needy-filter-helper.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-needy-item-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');

    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-needy-item-utils.php');

    $filter = RequestHelper::getParameter(NeedyFilterHelper::FILTER_FIELD);
    $page   = RequestHelper::getParameter(NeedyFilterHelper::PAGE_FIELD) - 1;

    $page = ($page && $page > 0) ? $page : 0;

    $needyItems = [];
    $needyItemsCountPages = 0;
    if ($filter == NeedyFilterHelper::ALL)
    {
        $needyItems = NeedyItemDBUtils::getAllNeedyItems($page);
        $needyItemsCountPages = NeedyItemDBUtils::getAllNeedyItemsCountPages();
    }
    elseif ($filter == NeedyFilterHelper::ALL_CHILDS)
    {
        $needyItems = NeedyItemDBUtils::getAllChildsItems($page);
        $needyItemsCountPages = NeedyItemDBUtils::getAllChildsItemsCountPages();
    }
    elseif ($filter == NeedyFilterHelper::URGENTLY_NEED_HELP_CHILDS)
    {
        $needyItems = NeedyItemDBUtils::getUrgentlyNeedHelpChildsItems($page);
        $needyItemsCountPages = NeedyItemDBUtils::getUrgentlyNeedHelpChildsItemsCountPages();
    }
    elseif ($filter == NeedyFilterHelper::NEED_HELP_CHILDS)
    {
        $needyItems = NeedyItemDBUtils::getNeedHelpChildsItems($page);
        $needyItemsCountPages = NeedyItemDBUtils::getNeedHelpChildsItemsCountPages();
    }
    elseif ($filter == NeedyFilterHelper::HELPED_CHILDS)
    {
        $needyItems = NeedyItemDBUtils::getHelpedChildsItems($page);
        $needyItemsCountPages = NeedyItemDBUtils::getHelpedChildsItemsCountPages();
    }
    elseif ($filter == NeedyFilterHelper::ALL_ORPHANAGES)
    {
        $needyItems = NeedyItemDBUtils::getAllOrphanagesItems($page);
        $needyItemsCountPages = NeedyItemDBUtils::getAllOrphanagesItemsCountPages();
    }

    $data = ["needyItems" => $needyItems, "needyItemsCountPages" => $needyItemsCountPages, "page" => $page];
    echo TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/needy-item-info-block.php', $data);