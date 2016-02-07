<?php
require_once(ABSPATH . WPINC . '/lib/helper/class-validate-helper.php');
require_once(ABSPATH . WPINC . '/lib/model/document/class-document-item.php');

class DocumentFormValidator
{
    static function validateAddDocumentParameters($parameters)
    {
        return self::validateBaseDocumentParameters($parameters);
    }

    static function validateEditDocumentParameters($parameters)
    {
        return self::validateBaseDocumentParameters($parameters) && self::validateDocumentId($parameters);
    }

    static function validateDocumentId($parameters)
    {
        return isset($parameters[DocumentItem::ID_FIELD]);
    }

    static function validateBaseDocumentParameters($parameters)
    {
        return (isset($parameters[DocumentItem::TITLE_FIELD]) && ValidateHelper::validateTextField($parameters[DocumentItem::TITLE_FIELD], DocumentItem::MIN_TITLE_LENGTH, DocumentItem::MAX_TITLE_LENGTH)) &&
        (isset($parameters[DocumentItem::INFO_FIELD]) && ValidateHelper::validateTextField($parameters[DocumentItem::INFO_FIELD], DocumentItem::MIN_INFO_LENGTH, DocumentItem::MAX_INFO_LENGTH));
    }
}