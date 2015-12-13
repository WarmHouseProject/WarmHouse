<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/validator/class-orphanage-form-validator.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-image-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-orphanage-db-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $orphanageInfo = RequestHelper::getOrphanageInfoFromRequest();
    if (OrphanageFormValidator::validateEditOrphanageParameters($orphanageInfo))
    {
        $orphanage = OrphanageDBUtils::getOrphanageById($orphanageInfo[Orphanage::ID_FIELD]);
        $imageId = $orphanage->image_id;
        if ($orphanage && OrphanageFormValidator::validateOrphanageAvatar($orphanageInfo))
        {
            $image = ImageUtils::createImageFromRequestParameters($orphanageInfo);
            if ($image)
            {
                ImageUtils::deleteImageById($orphanage->image_id);
                $imageId = $image->image_id;
            }
        }
        OrphanageDBUtils::updateOrphanageById($orphanageInfo, $imageId, $orphanage->orphanage_id);
    }

    wp_redirect(get_site_url() . '/orphanages'); exit;