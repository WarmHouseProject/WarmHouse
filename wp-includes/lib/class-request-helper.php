<?php
require_once(ABSPATH . WPINC . '/lib/class-child.php');

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
}