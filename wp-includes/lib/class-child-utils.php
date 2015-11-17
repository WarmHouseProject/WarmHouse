<?php

require_once( ABSPATH . WPINC . '/lib/class-child.php' );
require_once(ABSPATH . WPINC . '/lib/class-child-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/class-image-utils.php');

class ChildUtils
{
    static function deleteChildById($childId)
    {
        $child = ChildDBUtils::getChildById($childId);
        ImageUtils::deleteImageById($child->image_id);
        ChildDBUtils::deleteChildById($childId);
    }
}