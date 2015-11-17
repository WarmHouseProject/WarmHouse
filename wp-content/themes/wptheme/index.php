<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

    require_once(ABSPATH . WPINC . '/lib/class-child-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-template-utils.php');

    $childs = ChildDBUtils::getNeedHelpChilds();
    $data = ["childs" => $childs];

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
