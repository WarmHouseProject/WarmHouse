<?php
require_once(ABSPATH . WPINC . '/lib/helper/class-validate-helper.php');
require_once(ABSPATH . WPINC . '/lib/model/orphanage/class-orphanage-priority.php');

class OrphanageFormValidator
{
    static function validateAddOrphanageParameters($parameters)
    {
        return self::validateBaseOrphanageParameters($parameters) && self::validateOrphanageAvatar($parameters);
    }

    static function validateEditOrphanageParameters($parameters)
    {
        return self::validateBaseOrphanageParameters($parameters) && self::validateOrphanageId($parameters);
    }

    static function validateOrphanageId($parameters)
    {
        return isset($parameters[Orphanage::ID_FIELD]);
    }

    static function validateBaseOrphanageParameters($parameters)
    {
        return (isset($parameters[Orphanage::NAME_FIELD]) && ValidateHelper::validateTextField($parameters[Orphanage::NAME_FIELD], Orphanage::MIN_NAME_LENGTH, Orphanage::MAX_NAME_LENGTH)) &&
        (isset($parameters[Orphanage::SHORT_DESCRIPTION_FIELD]) && ValidateHelper::validateTextField($parameters[Orphanage::SHORT_DESCRIPTION_FIELD], Orphanage::MIN_SHORT_DESCRIPTION_LENGTH, Orphanage::MAX_SHORT_DESCRIPTION_LENGTH)) &&
        (isset($parameters[Orphanage::LONG_DESCRIPTION_FIELD]) && ValidateHelper::validateTextField($parameters[Orphanage::LONG_DESCRIPTION_FIELD], Orphanage::MIN_LONG_DESCRIPTION_LENGTH, Orphanage::MAX_LONG_DESCRIPTION_LENGTH)) &&
        (isset($parameters[Orphanage::CONTACT_INFO_FIELD]) && ValidateHelper::validateTextField($parameters[Orphanage::CONTACT_INFO_FIELD], Orphanage::MIN_CONTACT_LENGTH, Orphanage::MAX_CONTACT_LENGTH)) &&
        (isset($parameters[Orphanage::PRIORITY_FIELD]) && ValidateHelper::validateNumberField($parameters[Orphanage::PRIORITY_FIELD], OrphanagePriority::MIN_PRIORITY, OrphanagePriority::MAX_PRIORITY));
    }

    static function validateOrphanageAvatar($parameters)
    {
        return (isset($parameters[Orphanage::AVATAR_FIELD]) && ValidateHelper::validateFileField($parameters[Orphanage::AVATAR_FIELD]));
    }
}