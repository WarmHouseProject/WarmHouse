<?php
/*
Template Name: Stock Form
*/

    require_once(ABSPATH . WPINC . '/lib/model/stock/class-stock.php');
    require_once(ABSPATH . WPINC . '/lib/model/stock/class-stock-priority.php');
    require_once(ABSPATH . WPINC . '/lib/model/stock/class-stock-status.php');

    $avatar        = "";
    $name          = "";
    $stockStatus   = StockStatus::DEFAULT_STOCK_STATUS;
    $stockPriority = StockPriority::DEFAULT_STOCK_PRIORITY;
    $description   = "";
    $contactInfo   = "";

    $formRequestUrl = "/add-stock-controller.php";
    if (isset($stock))
    {
        $avatar        = "<img src='" . get_site_url() . ImageDBUtils::getImageLinkByImageId($stock->image_id) . "' class='file-preview-image' alt='avatar' title='avatar'>";
        $name          = $stock->name;
        $stockStatus   = $stock->status;
        $stockPriority = $stock->priority;
        $description   = $stock->description;
        $contactInfo   = $stock->contact_info;

        $formRequestUrl = "/edit-stock-controller.php";
    }

    $stockStatusesText = StockStatus::getStockStatusesText();
    $stockStatuses     = implode(",", StockStatus::getStockStatuses());

    get_header();
?>

    <div class="child-form">
        <div class="container">
            <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
            <form name="stock_form" action="<?= esc_url( home_url( $formRequestUrl ) ); ?>" method="post" enctype="multipart/form-data">
                <div class="col">
                    <div class="col-md-3">
                        <div class="form-group kv-avatar">
                            <div class="alert alert-danger" style="display: none;">Аватар не выбран.</div>
                            <input id="<?= Stock::AVATAR_FIELD ?>" name="<?= Stock::AVATAR_FIELD ?>" type="file" class="file-loading">
                        </div>
                        <script src="<?php echo get_template_directory_uri(); ?>/js/fileinput.js"></script>
                        <script>
                            jQuery(document).ready(function($) {
                                $("#avatar").fileinput({
                                    overwriteInitial: true,
                                    <?php if (!empty($avatar)): ?>
                                    initialPreview: ["<?= $avatar ?>"],
                                    <?php endif; ?>
                                    maxFileSize: 1500,
                                    showClose: false,
                                    showCaption: false,
                                    browseLabel: '',
                                    removeLabel: '',
                                    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
                                    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
                                    removeTitle: 'Cancel or reset changes',
                                    elErrorContainer: '#kv-avatar-errors',
                                    msgErrorClass: 'alert alert-block alert-danger',
                                    defaultPreviewContent: '<img src="<?php echo get_template_directory_uri(); ?>/images/default_avatar.jpg" alt="Your Avatar" style="width:160px">',
                                    layoutTemplates: {main2: '{preview} {remove} {browse}'},
                                    allowedFileExtensions: ["jpg", "png", "gif"]
                                });
                            });
                        </script>
                        <div class="form-group">
                            <label for="<?= Stock::STATUS_FIELD ?>">Статус:</label>
                            <div class="input-block">
                                <select class="form-control" name="<?= Stock::STATUS_FIELD ?>" id="<?= Stock::STATUS_FIELD ?>">
                                    <?php foreach ($stockStatusesText as $key => $value):?>
                                        <option value="<?= $key ?>" <?php if ($key == $stockStatus): ?>selected<?php endif; ?>><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="glyphicon form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="<?= Stock::PRIORITY_FIELD ?>">Приоритет:</label>
                            <div class="input-block">
                                <input type="number" name="<?= Stock::PRIORITY_FIELD ?>" min="<?= StockPriority::MIN_PRIORITY ?>" max="<?= StockPriority::MAX_PRIORITY ?>" class="form-control" id="<?= Stock::PRIORITY_FIELD ?>" value="<?= $stockPriority ?>">
                                <span class="glyphicon form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="<?= Stock::NAME_FIELD ?>">Название:</label>
                            <div class="input-block">
                                <input type="text" name="<?= Stock::NAME_FIELD ?>" maxlength="<?= Stock::MAX_NAME_LENGTH ?>" class="form-control" id="<?= Stock::NAME_FIELD ?>" value="<?= $name ?>">
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста от <?= Stock::MIN_NAME_LENGTH ?> до <?= Stock::MAX_NAME_LENGTH ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="<?= Stock::DESCRIPTION_FIELD ?>">Описание:</label>
                            <div class="input-block">
                                <textarea class="form-control form-element" name="<?= Stock::DESCRIPTION_FIELD ?>" rows="5" id="<?= Stock::DESCRIPTION_FIELD ?>" ><?= $description ?></textarea>
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста не менее <?= Stock::MIN_DESCRIPTION_LENGTH?> символов</span>
                            </div>
                        </div>
                        <div class="form-group button-row">
                            <input type="submit" class="btn btn-success success" value="Сохранить">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="label label-default">Отмена</span></a>
                            <?php if (isset($stock)): ?>
                                <a class="delete" href="<?php echo esc_url( home_url( '/delete-stock-controller.php?stock_id=' . $stock->stock_id ) ); ?>" onClick="return window.confirm('Вы дейтвительно хотите удалить?')">
                                    <span class="label label-danger">Удалить</span>
                                </a>
                            <?php endif;?>
                        </div>
                        <?php if (isset($stock)): ?>
                            <input type="hidden" name="<?= Stock::ID_FIELD ?>" id="<?= Stock::ID_FIELD ?>" value="<?= $stock->stock_id ?>">
                        <?php endif;?>
                    </div>
                </div>
            </form>
            <script src="<?php echo get_template_directory_uri(); ?>/js/validatefield.js"></script>
            <script>
                jQuery(document).ready(function($) {
                    $("form[name='stock_form']").submit(function(){
                        return validateTextField($('#<?= Stock::NAME_FIELD ?>'), <?= Stock::MIN_NAME_LENGTH ?>, <?= Stock::MAX_NAME_LENGTH ?>) &&
                            validateTextField($('#<?= Stock::DESCRIPTION_FIELD ?>'), <?= Stock::MIN_DESCRIPTION_LENGTH ?>, <?= Stock::MAX_DESCRIPTION_LENGTH ?>) &&
                            validateImageUploadingField($('.kv-avatar .file-input')) &&
                            validateSelectField($('#<?= Stock::STATUS_FIELD ?>'), [<?= $stockStatuses ?>]) &&
                            validateNumberField($('#<?= Stock::PRIORITY_FIELD ?>'), <?= stockPriority::MIN_PRIORITY ?>, <?= stockPriority::MAX_PRIORITY ?>);
                    });
                });
            </script>
        </div>
    </div>

<?php get_footer(); ?>