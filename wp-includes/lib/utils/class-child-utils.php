<?php

require_once(ABSPATH . WPINC . '/lib/model/child/class-child.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-child-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/class-image-utils.php');

class ChildUtils
{
    static function deleteChildById($childId)
    {
        $child = ChildDBUtils::getChildById($childId);
        ImageUtils::deleteImageById($child->image_id);
        ChildDBUtils::deleteChildById($childId);
    }
}