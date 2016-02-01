<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/validator/class-child-form-validator.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-image-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-child-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-needy-item-settings-db-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $childInfo = RequestHelper::getChildInfoFromRequest();
    if (ChildFormValidator::validateEditChildParameters($childInfo))
    {
        $child = ChildDBUtils::getChildById($childInfo[Child::ID_FIELD]);
        $imageId = $child->image_id;
        if ($child && ChildFormValidator::validateChildAvatar($childInfo))
        {
            $image = ImageUtils::createImageFromRequestParameters($childInfo);
            if ($image)
            {
                ImageUtils::deleteImageById($child->image_id);
                $imageId = $image->image_id;
            }
        }
        ChildDBUtils::updateChildById($childInfo, $imageId, $child->child_id);
        NeedyItemSettingsDBUtils::updateChildSettings($child->child_id, $childInfo[ChildSettings::SHOW_STAT_FIELD]);
    }

    wp_redirect(home_url()); exit;