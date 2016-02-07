<?php

require_once(ABSPATH . WPINC . '/lib/model/document/class-document-item.php');
require_once(ABSPATH . WPINC . '/lib/model/document/class-document-type.php');
require_once(ABSPATH . WPINC . '/lib/model/grant1/class-grant.php');
require_once(ABSPATH . WPINC . '/lib/model/program/class-program.php');

class DocumentItemDBUtils
{
    static function createGrant($grantInfo)
    {
        global $wpdb;
        $wpdb->query($wpdb->prepare("INSERT INTO `" . Grant::DB_TABLE_NAME .
            "` (" .
            Grant::TITLE_FIELD . ", " .
            Grant::INFO_FIELD .
            ") VALUES (%s, %s)",
            $grantInfo[Grant::TITLE_FIELD],
            $grantInfo[Grant::INFO_FIELD]));
        return $wpdb->insert_id;
    }

    static function createProgram($programInfo)
    {
        global $wpdb;
        $wpdb->query($wpdb->prepare("INSERT INTO `" . Program::DB_TABLE_NAME .
            "` (" .
            Program::TITLE_FIELD . ", " .
            Program::INFO_FIELD .
            ") VALUES (%s, %s)",
            $programInfo[Program::TITLE_FIELD],
            $programInfo[Program::INFO_FIELD]));
        return $wpdb->insert_id;
    }

    static function updateGrantById($grantInfo, $grantId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("UPDATE `" . Grant::DB_TABLE_NAME .
            "` SET " .
            Grant::TITLE_FIELD . " = %s, " .
            Grant::INFO_FIELD . " = %s " .
            " WHERE " . Grant::ID_FIELD . " = %d",
            $grantInfo[Grant::TITLE_FIELD],
            $grantInfo[Grant::INFO_FIELD],
            $grantId));
    }

    static function updateProgramById($programInfo, $programId)
    {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("UPDATE `" . Program::DB_TABLE_NAME .
            "` SET " .
            Program::TITLE_FIELD . " = %s, " .
            Program::INFO_FIELD . " = %s " .
            " WHERE " . Program::ID_FIELD . " = %d",
            $programInfo[Program::TITLE_FIELD],
            $programInfo[Program::INFO_FIELD],
            $programId));
    }

    static function getGrantById($grantId)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT " .
            Grant::ID_FIELD . " as " . DocumentItem::ID_FIELD . "," .
            Grant::TITLE_FIELD . " as " .  DocumentItem::TITLE_FIELD . "," .
            Grant::INFO_FIELD . " as " . DocumentItem::INFO_FIELD . "," .
            DocumentType::GRANT . " as " . DocumentItem::DOCUMENT_TYPE . "
            FROM `" . Grant::DB_TABLE_NAME . "` WHERE " . Grant::ID_FIELD . " = {$grantId}");
    }

    static function getProgramById($programId)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT " .
            Program::ID_FIELD . " as " . DocumentItem::ID_FIELD . "," .
            Program::TITLE_FIELD . " as " .  DocumentItem::TITLE_FIELD . "," .
            Program::INFO_FIELD . " as " . DocumentItem::INFO_FIELD . "," .
            DocumentType::PROGRAM . " as " . DocumentItem::DOCUMENT_TYPE . "
            FROM `" . Program::DB_TABLE_NAME . "` WHERE " . Program::ID_FIELD . " = {$programId}");
    }

    static function deleteGrantById($grantId)
    {
        global $wpdb;
        return $wpdb->get_row("DELETE FROM `" . Grant::DB_TABLE_NAME . "` WHERE " . Grant::ID_FIELD . " = {$grantId}");
    }

    static function deleteProgramById($programId)
    {
        global $wpdb;
        return $wpdb->get_row("DELETE FROM `" . Program::DB_TABLE_NAME . "` WHERE " . Program::ID_FIELD . " = {$programId}");
    }

    static function getAllGrants()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM `" . Grant::DB_TABLE_NAME . "`");
    }

    static function getAllPrograms()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM `" . Program::DB_TABLE_NAME . "`");
    }
}