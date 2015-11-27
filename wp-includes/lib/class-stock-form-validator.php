<?php
require_once(ABSPATH . WPINC . '/lib/class-validate-helper.php');
require_once(ABSPATH . WPINC . '/lib/class-stock-priority.php');

class StockFormValidator
{
    static function validateAddStockParameters($parameters)
    {
        return self::validateBaseStockParameters($parameters) && self::validateStockAvatar($parameters);
    }

    static function validateEditStockParameters($parameters)
    {
        return self::validateBaseStockParameters($parameters) && self::validateStockId($parameters);
    }

    static function validateStockId($parameters)
    {
        return isset($parameters[Stock::ID_FIELD]);
    }

    static function validateBaseStockParameters($parameters)
    {
        return (isset($parameters[Stock::NAME_FIELD]) && ValidateHelper::validateTextField($parameters[Stock::NAME_FIELD], Stock::MIN_NAME_LENGTH, Stock::MAX_NAME_LENGTH)) &&
        (isset($parameters[Stock::DESCRIPTION_FIELD]) && ValidateHelper::validateTextField($parameters[Stock::DESCRIPTION_FIELD], Stock::MIN_DESCRIPTION_LENGTH, Stock::MAX_DESCRIPTION_LENGTH)) &&
        (isset($parameters[Stock::PRIORITY_FIELD]) && ValidateHelper::validateNumberField($parameters[Stock::PRIORITY_FIELD], StockPriority::MIN_PRIORITY, StockPriority::MAX_PRIORITY));
    }

    static function validateStockAvatar($parameters)
    {
        return (isset($parameters[Stock::AVATAR_FIELD]) && ValidateHelper::validateFileField($parameters[Stock::AVATAR_FIELD]));
    }
}