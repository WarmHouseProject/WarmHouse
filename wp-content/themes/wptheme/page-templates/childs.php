<?php
/*
Template Name: Childs
*/

    require_once(ABSPATH . WPINC . '/lib/class-child-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-template-utils.php');

    $tabIndex = 1;
    $orphanages = ChildDBUtils::getNeedHelpChilds();
    $data = ["childs" => $orphanages];

    get_header();
?>

    <div class="services">
        <div class="container">
            <div class="services-top heading">
                <h2>им нужна ваша помощь</h2>
            </div>
            <?php if (is_user_logged_in()): ?>
                <div class="add_button">
                    <a href="<?= get_site_url(); ?>/add-child-page-controller.php"><span class="label label-primary">Добавить запись</span></a>
                </div>
            <?php endif; ?>
            <?php TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/child-info-block.php', $data); ?>
        </div>
    </div>
    <!--services-end-->

<?php get_footer(); ?>