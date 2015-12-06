<?php
/*
Template Name: Helped Childs
*/

    require_once(ABSPATH . WPINC . '/lib/class-child-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-template-utils.php');

    $tabIndex = 2;
    $childs = ChildDBUtils::getHelpedChilds();
    $data = ["childs" => $childs];

    get_header();
?>

<div class="services">
    <div class="container">
        <?php if (!empty($childs)): ?>
            <div class="services-top heading">
                <h2>вы им помогли</h2>
            </div>
        <?php endif; ?>
        <?php TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/child-info-block.php', $data); ?>
    </div>
</div>
<!--services-end-->

<?php get_footer(); ?>