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

require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-status.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-needy-item-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-child-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/class-needy-item-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');
require_once(ABSPATH . WPINC . '/lib/helper/class-needy-filter-helper.php');

$needyItems = NeedyItemDBUtils::getAllNeedyItemsByStatuses(0, NeedyStatus::getNeedHelpNeedyStatuses());
$needyItemsCountPages = NeedyItemDBUtils::getAllNeedyItemsByStatusesCountPages(NeedyStatus::getNeedHelpNeedyStatuses());
$data = ["needyItems" => $needyItems, "needyItemsCountPages" => $needyItemsCountPages];

get_header();
?>

<div class="services">
    <div class="container">
        <a id="toplink" name="top"></a>
        <div class="col-md-6">
            <?php if (is_user_logged_in()): ?>
                <div class="btn-group float-left">
                    <a href="<?= get_site_url(); ?>/add-child-page-controller.php"><span class="btn btn-primary">Добавить ребёнка</span></a>
                    <a href="<?= get_site_url(); ?>/add-orphanage-page-controller.php"><span class="btn btn-primary">Добавить детдом</span></a>
                </div>
                <div class="clearfix"></div>
            <?php else:?>
                <div class="services-top heading">
                    <h2 id="helpTitle">Наши подопечные</h2>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <div class="btn-group float-right">
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
        </div>
        <div class="clearfix"></div>
        <script>
            jQuery(document).ready(function($) {
                $('.dropdown-toggle-button').click(function(event){
                    $(this).toggleClass("open");
                    event.stopPropagation();
                });
                $(window).click(function(){
                    $('.dropdown-toggle-button').removeClass('open');
                });
            });
        </script>
        <div id="needyBlock">
            <?php TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/needy-item-info-block.php', $data); ?>
        </div>
    </div>
</div>
<div class="contact-information-block">
    <div class="container">
        <div class="col-md-7 main-info">
            <div class="contact-info-top heading">
                <h2>Контактная информация</h2>
            </div>
            <div class="text_block">
                Наш фонд создан для помощи тем, кто в ней нуждается больше всего - больным детям, детям из детских домов и приютов. У нас есть силы и желание помогать. Быть полезными. Мы хотим подарить прекрасное и здоровое детство.
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="contact-info">
                <h3 class="heading">Лучик Надежды</h3>
                <div class="text_block">
                    424002, г.Йошкар-Ола,<br/>
                    проспект Ленинский, дом 21, офис 25<br/>
                    Телефон: <span class="phone">+7 8362 43-43-19</span><br/>
                    Электронная почта:
                    <script type="text/javascript">//
                        // <![CDATA[
                        function gtfef(pe){return pe.replace(/[a-zA-Z]/g, function (m){return String.fromCharCode((m <= "Z" ? 210 : 3) >= (m = m.charCodeAt(0) + 41) ? m : m-46);})}document.write ('<a class="mailto"  href="mailto:' + gtfef('CLhmnB.sfijQmiP@PfsijO.Iz') + '">' + gtfef('CLhmnB.sfijQmiP@PfsijO.Iz') + '</a>');//]]>
                    </script>
                </div>
            </div>
            <div class="send-email">
                <a class="send-email-button" href="<?=home_url( '/contacts'); ?>">Обратиться с просьбой о помощи</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="map">
                <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=AjQJ-SA-CG5M72uIGoWAHliLyCgBm3Y4&width=100%&height=400&lang=ru_RU&sourceType=constructor"></script>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--services-end-->
<script>
    jQuery(document).ready(function($) {
        var needyBlock = $("#needyBlock");
        var needyPaginationBlock = $("#needyPaginationBlock");
        var currentFilter = <?= NeedyFilterHelper::ALL_NEEDY ?>;

        $('#allNeedy').click(function(){
            changeFilter(<?= NeedyFilterHelper::ALL ?>, 'Наши подопечные');
        });
        $('#allChilds').click(function(){
            changeFilter(<?= NeedyFilterHelper::ALL_CHILDS ?>, 'Наши подопечные');
        });
        $('#urgentlyNeedHelpChilds').click(function(){
            changeFilter(<?= NeedyFilterHelper::URGENTLY_NEED_HELP_CHILDS ?>, 'Срочно нужна помощь');
        });
        $('#needHelpChilds').click(function(){
            changeFilter(<?= NeedyFilterHelper::NEED_HELP_CHILDS ?>, 'Нуждаются в помощи');
        });
        $('#helpedChilds').click(function(){
            changeFilter(<?= NeedyFilterHelper::HELPED_CHILDS ?>, 'Вы им помогли');
        });
        $('#allOrphanages').click(function(){
            changeFilter(<?= NeedyFilterHelper::ALL_ORPHANAGES ?>, 'Детские дома');
        });

        $('.pagination .page').live('click', (function(){
            var page = $(this).text();
            changeFilter(currentFilter, null, page);
            scrollToListTop();
        }));

        function changeFilter(filter, title, page)
        {
            $.ajax({
                method: "POST",
                url: "/needy-item-info-controller-ajax.php",
                data: {filter: filter, page: page}
            })
                .done(function(content) {
                    currentFilter = filter;
                    needyBlock.html(content);
                    if (title) {
                        $('#helpTitle').text(title);
                    }
                });
        }

        function scrollToListTop()
        {
            $("html, body").animate({
                scrollTop: $("#toplink").offset().top + "px"
            }, {
                duration: 1500,
                easing: "swing"
            });
        }
    });
</script>

<?php get_footer(); ?>