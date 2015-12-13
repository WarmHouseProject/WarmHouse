<?php

class ValidateHelper
{
    static function validateTextField($value, $minLength, $maxLength)
    {
        return strlen($value) >= $minLength && ($maxLength < 0 || strlen($value) <= $maxLength);
    }

    static function validateSelectField($value, $values)
    {
        return in_array($value, $values);
    }

    static function validateNumberField($value, $min, $max)
    {
        return $value >= $min && $value <= $max;
    }

    static function validateFileField($file)
    {
        return isset($file["name"]) && ($file["error"] == "0") && ($file["size"] > 0) && is_uploaded_file($file["tmp_name"]);
    }
}