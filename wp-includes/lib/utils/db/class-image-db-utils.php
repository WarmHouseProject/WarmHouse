<?php

require_once(ABSPATH . WPINC . '/lib/model/image/class-image.php');

class ImageDBUtils
{
    const DEFAULT_IMAGE_LINK = "image_";
    const UPLOAD_DIR         = "/upload/child/images/image_";
    const ORIGINAL_DIR       = "/upload/child/images/original/image_";

    static function createImage($extension)
    {
        global $wpdb;
        if ($wpdb->query($wpdb->prepare("INSERT INTO `" . Image::DB_TABLE_NAME . "` (" . Image::LINK_FIELD . ") VALUES (%s)", self::DEFAULT_IMAGE_LINK))) {
            $imageId = $wpdb->insert_id;
            if ($wpdb->query($wpdb->prepare("UPDATE `" . Image::DB_TABLE_NAME .
                "` SET " .
                Image::LINK_FIELD . " = %s, " .
                Image::ORIGINAL_IMAGE_LINK_FIELD . " = %s " .
                " WHERE " . Image::ID_FIELD . " = %d",
                self::UPLOAD_DIR . $imageId . "." . $extension,
                self::ORIGINAL_DIR . $imageId . "." . $extension,
                $imageId)))
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

    static function getOriginalImageLinkByImageId($imageId)
    {
        global $wpdb;
        return $wpdb->get_var("SELECT " . Image::ORIGINAL_IMAGE_LINK_FIELD . " FROM `" . Image::DB_TABLE_NAME . "` WHERE " . Image::ID_FIELD . " = {$imageId}");
    }
}