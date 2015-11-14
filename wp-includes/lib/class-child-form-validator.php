<?php
require_once(ABSPATH . WPINC . '/lib/class-validate-helper.php');
require_once(ABSPATH . WPINC . '/lib/class-child-status.php');
require_once(ABSPATH . WPINC . '/lib/class-child-priority.php');

class ChildFormValidator
{
    static function validateAddChildParameters($parameters)
    {
        return self::validateBaseChildParameters($parameters) && self::validateChildAvatar($parameters);
    }

    static function validateEditChildParameters($parameters)
    {
        return self::validateBaseChildParameters($parameters) && self::validateChildId($parameters);
    }

    static function validateChildId($parameters)
    {
        return isset($parameters[Child::ID_FIELD]);
    }

    static function validateBaseChildParameters($parameters)
    {
        return (isset($parameters[Child::NAME_FIELD]) && ValidateHelper::validateTextField($parameters[Child::NAME_FIELD], Child::MIN_NAME_LENGTH, Child::MAX_NAME_LENGTH)) &&
        (isset($parameters[Child::SHORT_DESCRIPTION_FIELD]) && ValidateHelper::validateTextField($parameters[Child::SHORT_DESCRIPTION_FIELD], Child::MIN_SHORT_DESCRIPTION_LENGTH, Child::MAX_SHORT_DESCRIPTION_LENGTH)) &&
        (isset($parameters[Child::LONG_DESCRIPTION_FIELD]) && ValidateHelper::validateTextField($parameters[Child::LONG_DESCRIPTION_FIELD], Child::MIN_LONG_DESCRIPTION_LENGTH, Child::MAX_LONG_DESCRIPTION_LENGTH)) &&
        (isset($parameters[Child::STATUS_FIELD]) && ValidateHelper::validateSelectField($parameters[Child::STATUS_FIELD], ChildStatus::getChildStatuses())) &&
        (isset($parameters[Child::PRIORITY_FIELD]) && ValidateHelper::validateNumberField($parameters[Child::PRIORITY_FIELD], ChildPriority::MIN_PRIORITY, ChildPriority::MAX_PRIORITY));
    }

    static function validateChildAvatar($parameters)
    {
        return (isset($parameters[Child::AVATAR_FIELD]) && ValidateHelper::validateFileField($parameters[Child::AVATAR_FIELD]));
    }
}