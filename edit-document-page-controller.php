<?php
    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');
    require_once(ABSPATH . WPINC . '/lib/model/document/class-document-item.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-document-item-db-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $documentType = RequestHelper::getParameter(DocumentItem::DOCUMENT_TYPE);
    $documentId   = RequestHelper::getParameter(DocumentItem::ID_FIELD);

    if ($documentType == DocumentType::GRANT)
    {
        $document = DocumentItemDBUtils::getGrantById($documentId);
    }
    else
    {
        $document = DocumentItemDBUtils::getProgramById($documentId);
    }

    $data = ["documentType" => $documentType, "document" => $document];
    TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/document-form.php', $data);