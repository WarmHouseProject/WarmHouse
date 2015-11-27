<?php
/*
Template Name: Orphanage
*/

    require_once(ABSPATH . WPINC . '/lib/class-orphanage-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-template-utils.php');

    $tabIndex = 2;
    $orphanages = OrphanageDBUtils::getOrphanages();
    $data = ["orphanages" => $orphanages];

    get_header();
?>

<div class="services">
    <div class="container">
        <?php if (is_user_logged_in()): ?>
            <div class="add_button">
                <a href="<?= get_site_url(); ?>/add-orphanage-page-controller.php"><span class="label label-primary">Добавить запись</span></a>
            </div>
        <?php endif; ?>
        <?php TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/orphanage-info-block.php', $data); ?>
    </div>
</div>
<!--services-end-->

<?php get_footer(); ?>
