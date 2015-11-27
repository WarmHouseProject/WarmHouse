<?php
require_once(ABSPATH . WPINC . '/lib/class-child.php');
require_once(ABSPATH . WPINC . '/lib/class-orphanage.php');

class RequestHelper
{
    static function getParameter($parameterName)
    {
        $parameter = isset($_GET[$parameterName]) ? $_GET[$parameterName] : null;
        if (!$parameter)
        {
            $parameter = isset($_POST[$parameterName]) ? $_POST[$parameterName] : null;
        }
        return $parameter;
    }

    static function getFile($parameterName)
    {
        $parameter = isset($_FILES[$parameterName]) ? $_FILES[$parameterName] : null;
        return $parameter;
    }

    static function getChildInfoFromRequest()
    {
        $childInfo = [];
        $childInfo[Child::ID_FIELD]                = self::getParameter(Child::ID_FIELD);
        $childInfo[Child::NAME_FIELD]              = self::getParameter(Child::NAME_FIELD);
        $childInfo[Child::SHORT_DESCRIPTION_FIELD] = self::getParameter(Child::SHORT_DESCRIPTION_FIELD);
        $childInfo[Child::LONG_DESCRIPTION_FIELD]  = self::getParameter(Child::LONG_DESCRIPTION_FIELD);
        $childInfo[Child::CONTACT_INFO_FIELD]      = self::getParameter(Child::CONTACT_INFO_FIELD);
        $childInfo[Child::STATUS_FIELD]            = self::getParameter(Child::STATUS_FIELD);
        $childInfo[Child::PRIORITY_FIELD]          = self::getParameter(Child::PRIORITY_FIELD);
        $childInfo{Child::AVATAR_FIELD}            = self::getFile(Child::AVATAR_FIELD);
        return $childInfo;
    }

    static function getOrphanageInfoFromRequest()
    {
        $childInfo = [];
        $childInfo[Orphanage::ID_FIELD]           = self::getParameter(Orphanage::ID_FIELD);
        $childInfo[Orphanage::NAME_FIELD]         = self::getParameter(Orphanage::NAME_FIELD);
        $childInfo[Orphanage::DESCRIPTION_FIELD]  = self::getParameter(Orphanage::DESCRIPTION_FIELD);
        $childInfo[Orphanage::CONTACT_INFO_FIELD] = self::getParameter(Orphanage::CONTACT_INFO_FIELD);
        $childInfo[Orphanage::PRIORITY_FIELD]     = self::getParameter(Orphanage::PRIORITY_FIELD);
        $childInfo{Orphanage::AVATAR_FIELD}       = self::getFile(Orphanage::AVATAR_FIELD);
        return $childInfo;
    }

    static function getStockInfoFromRequest()
    {
        $childInfo = [];
        $childInfo[Stock::ID_FIELD]          = self::getParameter(Stock::ID_FIELD);
        $childInfo[Stock::NAME_FIELD]        = self::getParameter(Stock::NAME_FIELD);
        $childInfo[Stock::DESCRIPTION_FIELD] = self::getParameter(Stock::DESCRIPTION_FIELD);
        $childInfo[Stock::PRIORITY_FIELD]    = self::getParameter(Stock::PRIORITY_FIELD);
        $childInfo{Stock::AVATAR_FIELD}      = self::getFile(Stock::AVATAR_FIELD);
        return $childInfo;
    }
}