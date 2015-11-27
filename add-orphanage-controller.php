<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/class-orphanage-form-validator.php');
    require_once(ABSPATH . WPINC . '/lib/class-orphanage-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-image-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $orphanageInfo = RequestHelper::getOrphanageInfoFromRequest();
    if (OrphanageFormValidator::validateAddOrphanageParameters($orphanageInfo)) {
        $image = ImageUtils::createImageFromRequestParameters($orphanageInfo);
        if ($image)
        {
            OrphanageDBUtils::createOrphanage($orphanageInfo, $image->image_id);
        }
    }

    wp_redirect(get_site_url() . '/orphanages'); exit;