<?php
/*
Template Name: Stocks
*/

    require_once(ABSPATH . WPINC . '/lib/utils/db/class-stock-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-template-utils.php');
    require_once(ABSPATH . WPINC . '/lib/helper/class-stock-filter-helper.php');

    $tabIndex = 4;
    $stocks = StockDBUtils::getActiveStocks();
    $data = ["stocks" => $stocks];

    get_header();
?>

    <div class="services">
        <div class="container">
            <div class="col-md-6">
                <?php if (is_user_logged_in()): ?>
                    <div class="btn-group float-left">
                        <a href="<?= get_site_url(); ?>/add-stock-page-controller.php"><span class="btn btn-primary">Добавить мероприятие</span></a>
                    </div>
                    <div class="clearfix"></div>
                <?php else:?>
                    <div class="services-top heading">
                        <h2 id="helpTitle">Действующие мероприятия</h2>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <div class="btn-group float-right">
                    <button type="button" class="btn btn-primary" id="active">Действующие</button>
                    <button type="button" class="btn btn-primary" id="inactive">Завершённые</button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="stocks-block" id="stockBlock">
            <?php TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/stock-info-block.php', $data); ?>
        </div>
    </div>
    <!--services-end-->
    <script>
        jQuery(document).ready(function($) {
            var stockBlock = $("#stockBlock");

            $('#active').click(function(){
                changeFilter(<?= StockFilterHelper::ACTIVE ?>, 'Действующие мероприятия');
            });
            $('#inactive').click(function(){
                changeFilter(<?= StockFilterHelper::INACTIVE ?>, 'Завершённые мероприятия');
            });

            function changeFilter(filter, title)
            {
                $.ajax({
                    method: "POST",
                    url: "/stock-item-info-controller-ajax.php",
                    data: {filter: filter}
                })
                    .done(function(content) {
                        stockBlock.html(content);
                        if (title) {
                            $('#helpTitle').text(title);
                        }
                    });
            }
        });
    </script>

<?php get_footer(); ?>