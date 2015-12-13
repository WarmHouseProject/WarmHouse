<?php

    require_once(ABSPATH . WPINC . '/lib/model/image/class-image.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');

    class ImageUtils
    {
        static function resizeAvatarImage($image)
        {
            list($srcWidth, $srcHeight, $type) = getimagesize($image);
            $types = array('', 'gif', 'jpeg', 'png');
            $ext = $types[$type];
            if ($ext)
            {
                $func = 'imagecreatefrom'.$ext;
                $src = $func($image);
            }
            else
            {
                return false;
            }

            $imgObj = imagecreatetruecolor(Image::AVATAR_IMAGE_SIZE, Image::AVATAR_IMAGE_SIZE);
            if ($srcWidth > $srcHeight)
            {
                imagecopyresized($imgObj, $src, 0, 0, round(($srcWidth - $srcHeight) / 2), 0, Image::AVATAR_IMAGE_SIZE, Image::AVATAR_IMAGE_SIZE, $srcHeight, $srcHeight);
            }
            if ($srcWidth < $srcHeight)
            {
                imagecopyresized($imgObj, $src, 0, 0, 0, 0, Image::AVATAR_IMAGE_SIZE, Image::AVATAR_IMAGE_SIZE, $srcWidth, $srcWidth);
            }
            if ($srcWidth == $srcHeight)
            {
                imagecopyresized($imgObj, $src, 0, 0, 0, 0, Image::AVATAR_IMAGE_SIZE, Image::AVATAR_IMAGE_SIZE, $srcWidth, $srcWidth);
            }

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
                self::resizeAvatarImage(ABSPATH . $image->link);
                $result = $image;
            }
            return $result;
        }

        static function deleteImageById($imageId)
        {
            $imageLink = ImageDBUtils::getImageLinkByImageId($imageId);
            ImageDBUtils::deleteImageById($imageId);
            @unlink(ABSPATH . $imageLink);
        }
    }