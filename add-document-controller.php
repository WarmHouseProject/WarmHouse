<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/validator/class-document-form-validator.php');
    require_once(ABSPATH . WPINC . '/lib/model/document/class-document-item.php');
    require_once(ABSPATH . WPINC . '/lib/model/document/class-document-type.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-document-item-db-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $documentInfo = RequestHelper::getDocumentInfoFromRequest();
    if (DocumentFormValidator::validateAddDocumentParameters($documentInfo)) {
        if ($documentInfo[DocumentItem::DOCUMENT_TYPE] == DocumentType::GRANT) {
            DocumentItemDBUtils::createGrant($documentInfo);
        }
        if ($documentInfo[DocumentItem::DOCUMENT_TYPE] == DocumentType::PROGRAM) {
            DocumentItemDBUtils::createProgram($documentInfo);
        }
    }

    wp_redirect(get_site_url() . '/projects'); exit;