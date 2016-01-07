<?php foreach ($stocks as $index => $stock): ?>
    <div class="stock <?php if ($index % 2 == 0): ?>grey_block<?php else: ?>white_block<?php endif; ?>">
        <div class="container stock-info">
            <div class="col">
                <div class="col-sm-3">
                    <div class="inner-container image">
                        <div class="inner-image-block">
                            <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($stock->image_id) ?>" class="img-thumbnail stock-image" alt="<?= $stock->name ?>">
                        </div>
                    </div>
                    <?php if (is_user_logged_in()): ?>
                        <div class="inner-container edit">
                            <a href="<?= esc_url( home_url( '/edit-stock-page-controller.php?stock_id=' . $stock->stock_id ) ); ?>"><span class="label label-warning">Редактировать</span></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-9">
                    <div class="inner-container">
                        <h2 class="head blue_text"><?= $stock->name ?></h2>
                    </div>
                    <div class="inner-container">
                        <div class="short-description text_block"><?= $stock->description ?></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>