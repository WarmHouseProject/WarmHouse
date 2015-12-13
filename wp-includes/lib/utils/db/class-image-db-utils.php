<?php

require_once(ABSPATH . WPINC . '/lib/model/image/class-image.php');

class ImageDBUtils
{
    const DEFAULT_IMAGE_LINK = "image_";
    const UPLOAD_DIR         = "/upload/child/images/image_";

    static function createImage($extension)
    {
        global $wpdb;
        if ($wpdb->query($wpdb->prepare("INSERT INTO `" . Image::DB_TABLE_NAME . "` (" . Image::LINK_FIELD . ") VALUES (%s)", self::DEFAULT_IMAGE_LINK))) {
            $imageId = $wpdb->insert_id;
            if ($wpdb->update(Image::DB_TABLE_NAME, array("link" => self::UPLOAD_DIR . $imageId . "." . $extension), array("image_id" => $imageId), array("%s"), array("%d")))
            {
                return $wpdb->get_row("SELECT * FROM `" . Image::DB_TABLE_NAME . "` WHERE " . Image::ID_FIELD . " = {$imageId}");
            }
        }
        return null;
    }

    static function deleteImageById($imageId)
    {
        global $wpdb;
        return $wpdb->get_var("DELETE FROM `" . Image::DB_TABLE_NAME . "` WHERE " . Image::ID_FIELD . " = {$imageId}");
    }

    static function getImageLinkByImageId($imageId)
    {
        global $wpdb;
        return $wpdb->get_var("SELECT " . Image::LINK_FIELD . " FROM `" . Image::DB_TABLE_NAME . "` WHERE " . Image::ID_FIELD . " = {$imageId}");
    }
}