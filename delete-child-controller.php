<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/class-child-form-validator.php');
    require_once(ABSPATH . WPINC . '/lib/class-child-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $childInfo = RequestHelper::getChildInfoFromRequest();
    if (ChildFormValidator::validateChildId($childInfo))
    {
        ChildUtils::deleteChildById($childInfo[Child::ID_FIELD]);
    }

    wp_redirect(home_url()); exit;