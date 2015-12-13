<?php
/*
Template Name: Helped Childs
*/

    require_once(ABSPATH . WPINC . '/lib/utils/db/class-child-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');

    $needyItems = ChildDBUtils::getHelpedChilds();
    $data = ["needyItems" => $needyItems];

    get_header();
?>

<div class="services">
    <div class="container">
        <?php if (!empty($needyItems)): ?>
            <div class="services-top heading">
                <h2>вы им помогли</h2>
            </div>
        <?php endif; ?>
        <?php TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/needy-item-info-block.php', $data); ?>
    </div>
</div>
<!--services-end-->

<?php get_footer(); ?>