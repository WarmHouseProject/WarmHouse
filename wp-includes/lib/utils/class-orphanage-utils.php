<?php

require_once(ABSPATH . WPINC . '/lib/model/orphanage/class-orphanage.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-orphanage-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/class-image-utils.php');

class OrphanageUtils
{
    static function deleteOrphanageById($orphanageId)
    {
        $orphanage = OrphanageDBUtils::getOrphanageById($orphanageId);
        ImageUtils::deleteImageById($orphanage->image_id);
        OrphanageDBUtils::deleteOrphanageById($orphanageId);
    }
}