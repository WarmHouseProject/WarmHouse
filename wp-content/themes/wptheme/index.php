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

require_once(ABSPATH . WPINC . '/lib/utils/db/class-needy-item-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-child-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/class-needy-item-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');
require_once(ABSPATH . WPINC . '/lib/helper/class-filter-helper.php');

$needyItems = NeedyItemDBUtils::getAllNeedyItems();
$data = ["needyItems" => $needyItems];

get_header();
?>

<div class="services">
    <div class="container">
        <div class="services-top heading">
            <h2>Вы можете им помочь</h2>
        </div>
        <?php if (is_user_logged_in()): ?>
            <div class="btn-group float-right">
                <a href="<?= get_site_url(); ?>/add-child-page-controller.php"><span class="btn btn-primary">Добавить ребёнка</span></a>
                <a href="<?= get_site_url(); ?>/add-orphanage-page-controller.php"><span class="btn btn-primary">Добавить детдом</span></a>
            </div>
            <div class="clearfix"></div>
        <?php endif; ?>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="allNeedy">Все</button>

            <div class="btn-group dropdown-toggle-button">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Дети
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu primary-color">
                    <li id="allChilds"><a href="javascript:void(0)">Все</a></li>
                    <li id="urgentlyNeedHelpChilds"><a href="javascript:void(0)">Срочно нужна помощь</a></li>
                    <li id="needHelpChilds"><a href="javascript:void(0)">Нужна помощь</a></li>
                    <li id="helpedChilds"><a href="javascript:void(0)">Помогли</a></li>
                </ul>
            </div>

            <button type="button" class="btn btn-primary" id="allOrphanages">Детские дома</button>
        </div>
        <script>
            jQuery(document).ready(function($) {
                $('.dropdown-toggle-button').click(function(){
                    $(this).toggleClass("open");
                });
            });
        </script>
        <div id="NeedyBlock">
            <?php TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/needy-item-info-block.php', $data); ?>
        </div>
    </div>
</div>
<!--services-end-->
<script>
    jQuery(document).ready(function($) {
        var needyBlock = $("#NeedyBlock");

        $('#allNeedy').click(function(){
            changeFilter(<?= FilterHelper::ALL ?>);
        });
        $('#allChilds').click(function(){
            changeFilter(<?= FilterHelper::ALL_CHILDS ?>);
        });
        $('#urgentlyNeedHelpChilds').click(function(){
            changeFilter(<?= FilterHelper::URGENTLY_NEED_HELP_CHILDS ?>);
        });
        $('#needHelpChilds').click(function(){
            changeFilter(<?= FilterHelper::NEED_HELP_CHILDS ?>);
        });
        $('#helpedChilds').click(function(){
            changeFilter(<?= FilterHelper::HELPED_CHILDS ?>);
        });
        $('#allOrphanages').click(function(){
            changeFilter(<?= FilterHelper::ALL_ORPHANAGES ?>);
        });

        function changeFilter(filter)
        {
            $.ajax({
                method: "POST",
                url: "/needy-item-info-controller-ajax.php",
                data: {filter: filter}
            })
                .done(function(content) {
                    needyBlock.html(content);
                });
        }
    });
</script>

<?php get_footer(); ?>