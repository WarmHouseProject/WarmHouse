<?php
    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');

    if (!is_user_logged_in())
    {
        wp_redirect(home_url()); exit;
    }

    TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/stock-form.php');