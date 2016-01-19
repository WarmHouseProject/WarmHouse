<?php

    require_once(ABSPATH . WPINC . '/lib/model/image/class-image.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');

    class ImageUtils
    {
        static function resizeAvatarImage($image)
        {
            return self::resizeImage($image, Image::AVATAR_IMAGE_WIDTH, Image::AVATAR_IMAGE_HEIGHT);
        }

        static function resizeImage($image, $width, $height)
        {
            list($srcWidth, $srcHeight, $type) = getimagesize($image);
            $types = array('', 'gif', 'jpeg', 'png');
            $ext = $types[$type];
            if ($ext)
            {
                $func = 'imagecreatefrom' . $ext;
                $src = $func($image);
            }
            else
            {
                return false;
            }

            $imgObj = imagecreatetruecolor($width, $height);
            if ($srcHeight / $srcWidth > $height / $width)
            {
                $calcWidth  = $srcWidth;
                $calcHeight = $calcWidth * $height / $width;
            }
            else
            {
                $calcHeight = $srcHeight;
                $calcWidth  = $calcHeight * $width / $height;
            }
            imagecopyresized($imgObj, $src, 0, 0, round(($srcWidth - $calcWidth) / 2), round(($srcHeight - $calcHeight) / 2), $width, $height, $calcWidth, $calcHeight);

            if ($type == 2)
            {
                return imagejpeg($imgObj, $image, 100);
            }
            else
            {
                $func = 'image' . $ext;
                return $func($imgObj, $image);
            }
        }

        static function createImageFromRequestParameters($requestInfo)
        {
            $result = null;
            $tmpName = $requestInfo[Child::AVATAR_FIELD]["tmp_name"];
            $fileName = $requestInfo[Child::AVATAR_FIELD]["name"];

            $fileInfo = new SplFileInfo($fileName);

            $image = ImageDBUtils::createImage($fileInfo->getExtension());
            if ($image && move_uploaded_file($tmpName, ABSPATH . $image->link))
            {
                WP_Filesystem();
                global $wp_filesystem;
                $wp_filesystem->copy(ABSPATH . $image->link, ABSPATH . $image->original_image_link, true, FS_CHMOD_FILE);
                self::resizeAvatarImage(ABSPATH . $image->link);
                $result = $image;
            }
            return $result;
        }

        static function deleteImageById($imageId)
        {
            $imageLink = ImageDBUtils::getImageLinkByImageId($imageId);
            $originalImageLink = ImageDBUtils::getOriginalImageLinkByImageId($imageId);
            ImageDBUtils::deleteImageById($imageId);
            @unlink(ABSPATH . $imageLink);
            @unlink(ABSPATH . $originalImageLink);
        }
    }