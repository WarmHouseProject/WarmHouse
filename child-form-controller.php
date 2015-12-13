<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/validator/class-child-form-validator.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-child-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-image-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $childInfo = RequestHelper::getChildInfoFromRequest();
    if (ChildFormValidator::validateAddChildParameters($childInfo)) {
        $image = ImageUtils::createImageFromRequestParameters($childInfo);
        if ($image)
        {
            ChildDBUtils::createChild($childInfo, $image->image_id);
        }
    }

    wp_redirect(home_url()); exit;