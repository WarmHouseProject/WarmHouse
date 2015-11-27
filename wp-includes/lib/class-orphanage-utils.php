<?php

require_once( ABSPATH . WPINC . '/lib/class-orphanage.php' );
require_once(ABSPATH . WPINC . '/lib/class-orphanage-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/class-image-utils.php');

class OrphanageUtils
{
    static function deleteOrphanageById($orphanageId)
    {
        $orphanage = OrphanageDBUtils::getOrphanageById($orphanageId);
        ImageUtils::deleteImageById($orphanage->image_id);
        OrphanageDBUtils::deleteOrphanageById($orphanageId);
    }
}