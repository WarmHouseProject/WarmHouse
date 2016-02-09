<?php
require_once(ABSPATH . WPINC . '/lib/helper/class-needy-filter-helper.php');
require_once(ABSPATH . WPINC . '/lib/model/child/class-child.php');
require_once(ABSPATH . WPINC . '/lib/model/child_settings/class-child-settings.php');
require_once(ABSPATH . WPINC . '/lib/model/orphanage/class-orphanage.php');
require_once(ABSPATH . WPINC . '/lib/model/orphanage_settings/class-orphanage-settings.php');
require_once(ABSPATH . WPINC . '/lib/model/document/class-document-item.php');

class RequestHelper
{
    static function getParameter($parameterName)
    {
        self::stripsParameters();
        $parameter = isset($_GET[$parameterName]) ? $_GET[$parameterName] : null;
        if (!$parameter)
        {
            $parameter = isset($_POST[$parameterName]) ? $_POST[$parameterName] : null;
        }
        return $parameter;
    }

    static function stripsParameters()
    {
        self::strips($_POST);
        self::strips($_GET);
    }

    static function strips(&$parameter)
    {
        if (is_array($parameter))
        {
            foreach($parameter as $k => $v)
            {
                $parameter[$k] = stripslashes($parameter[$k]);
            }
        }
        else
        {
            $parameter = stripslashes($parameter);
        }
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
        $childInfo[Child::PURPOSE_FIELD]           = self::getParameter(Child::PURPOSE_FIELD);
        $childInfo[ChildSettings::SHOW_STAT_FIELD] = self::getParameter(ChildSettings::SHOW_STAT_FIELD);
        $childInfo[Child::CONTACT_INFO_FIELD]      = self::getParameter(Child::CONTACT_INFO_FIELD);
        $childInfo[Child::STATUS_FIELD]            = self::getParameter(Child::STATUS_FIELD);
        $childInfo[Child::PRIORITY_FIELD]          = self::getParameter(Child::PRIORITY_FIELD);
        $childInfo{Child::AVATAR_FIELD}            = self::getFile(Child::AVATAR_FIELD);
        return $childInfo;
    }

    static function getOrphanageInfoFromRequest()
    {
        $childInfo = [];
        $childInfo[Orphanage::ID_FIELD]                = self::getParameter(Orphanage::ID_FIELD);
        $childInfo[Orphanage::NAME_FIELD]              = self::getParameter(Orphanage::NAME_FIELD);
        $childInfo[Orphanage::SHORT_DESCRIPTION_FIELD] = self::getParameter(Orphanage::SHORT_DESCRIPTION_FIELD);
        $childInfo[Orphanage::LONG_DESCRIPTION_FIELD]  = self::getParameter(Orphanage::LONG_DESCRIPTION_FIELD);
        $childInfo[Orphanage::PURPOSE_FIELD]           = self::getParameter(Orphanage::PURPOSE_FIELD);
        $childInfo[OrphanageSettings::SHOW_STAT_FIELD] = self::getParameter(OrphanageSettings::SHOW_STAT_FIELD);
        $childInfo[Orphanage::CONTACT_INFO_FIELD]      = self::getParameter(Orphanage::CONTACT_INFO_FIELD);
        $childInfo[Orphanage::PRIORITY_FIELD]          = self::getParameter(Orphanage::PRIORITY_FIELD);
        $childInfo{Orphanage::AVATAR_FIELD}            = self::getFile(Orphanage::AVATAR_FIELD);
        return $childInfo;
    }

    static function getStockInfoFromRequest()
    {
        $childInfo = [];
        $childInfo[Stock::ID_FIELD]          = self::getParameter(Stock::ID_FIELD);
        $childInfo[Stock::NAME_FIELD]        = self::getParameter(Stock::NAME_FIELD);
        $childInfo[Stock::DESCRIPTION_FIELD] = self::getParameter(Stock::DESCRIPTION_FIELD);
        $childInfo[Stock::STATUS_FIELD]      = self::getParameter(Stock::STATUS_FIELD);
        $childInfo[Stock::PRIORITY_FIELD]    = self::getParameter(Stock::PRIORITY_FIELD);
        $childInfo{Stock::AVATAR_FIELD}      = self::getFile(Stock::AVATAR_FIELD);
        return $childInfo;
    }

    static function getDocumentInfoFromRequest()
    {
        $documentInfo = [];
        $documentInfo[DocumentItem::ID_FIELD]      = self::getParameter(DocumentItem::ID_FIELD);
        $documentInfo[DocumentItem::TITLE_FIELD]   = self::getParameter(DocumentItem::TITLE_FIELD);
        $documentInfo[DocumentItem::INFO_FIELD]    = self::getParameter(DocumentItem::INFO_FIELD);
        $documentInfo[DocumentItem::DOCUMENT_TYPE] = self::getParameter(DocumentItem::DOCUMENT_TYPE);
        return $documentInfo;
    }
}