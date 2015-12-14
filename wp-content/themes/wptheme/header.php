<?php
	require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');
	TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/header-block.php', []);
	TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/banner-block.php', []);
?>