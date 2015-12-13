<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-child-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    $childId = RequestHelper::getParameter("child_id");
    $child = null;

    if ($childId)
    {
        $child = ChildDBUtils::getChildById($childId);
    }

    $data = ["child" => $child];
    TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/child_form.php', $data);
