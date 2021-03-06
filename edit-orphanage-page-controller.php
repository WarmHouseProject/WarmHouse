<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-orphanage-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $orphanageId = RequestHelper::getParameter("orphanage_id");
    $orphanage = null;

    if ($orphanageId)
    {
        $orphanage = OrphanageDBUtils::getOrphanageById($orphanageId);
    }

    $data = ["orphanage" => $orphanage];
    TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/orphanage-form.php', $data);