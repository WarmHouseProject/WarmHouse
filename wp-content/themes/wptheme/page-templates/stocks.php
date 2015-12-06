<?php
/*
Template Name: Stocks
*/

    require_once(ABSPATH . WPINC . '/lib/class-stock-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-image-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-template-utils.php');

    $tabIndex = 4;
    $stocks = StockDBUtils::getStocks();
    $data = ["stocks" => $stocks];

    get_header();
?>

    <div class="services">
        <div class="container">
            <?php if (is_user_logged_in()): ?>
                <div class="add_button">
                    <a href="<?= get_site_url(); ?>/add-stock-page-controller.php"><span class="label label-primary">Добавить запись</span></a>
                </div>
            <?php endif; ?>
            <?php TemplateUtils::includeTemplate(get_template_directory() . '/page-templates/stock-info-block.php', $data); ?>
        </div>
    </div>
    <!--services-end-->

<?php get_footer(); ?>