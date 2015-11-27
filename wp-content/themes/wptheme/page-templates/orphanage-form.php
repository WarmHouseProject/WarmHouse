<?php
/*
Template Name: Orphanage Form
*/

    require_once( ABSPATH . WPINC . '/lib/class-orphanage.php' );
    require_once( ABSPATH . WPINC . '/lib/class-orphanage-priority.php' );

    $avatar            = "";
    $name              = "";
    $orphanagePriority = OrphanagePriority::DEFAULT_ORPHANAGE_PRIORITY;
    $description       = "";
    $contactInfo       = "";

    $formRequestUrl = "/add-orphanage-controller.php";
    if (isset($stock))
    {
        $avatar            = "<img src='" . get_site_url() . ImageDBUtils::getImageLinkByImageId($stock->image_id) . "' class='file-preview-image' alt='avatar' title='avatar'>";
        $name              = $stock->name;
        $orphanagePriority = $stock->priority;
        $description       = $stock->description;
        $contactInfo       = $stock->contact_info;

        $formRequestUrl = "/edit-orphanage-controller.php";
    }

    get_header();
?>

    <div class="child-form">
        <div class="container">
            <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
            <form name="orphanage_form" action="<?= esc_url( home_url( $formRequestUrl ) ); ?>" method="post" enctype="multipart/form-data">
                <div class="col">
                    <div class="col-md-3">
                        <div class="form-group kv-avatar">
                            <div class="alert alert-danger" style="display: none;">Аватар не выбран.</div>
                            <input id="<?= Orphanage::AVATAR_FIELD ?>" name="<?= Orphanage::AVATAR_FIELD ?>" type="file" class="file-loading">
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
                            <label for="<?= Orphanage::PRIORITY_FIELD ?>">Приоритет:</label>
                            <div class="input-block">
                                <input type="number" name="<?= Orphanage::PRIORITY_FIELD ?>" min="<?= OrphanagePriority::MIN_PRIORITY ?>" max="<?= OrphanagePriority::MAX_PRIORITY ?>" class="form-control" id="<?= Orphanage::PRIORITY_FIELD ?>" value="<?= $orphanagePriority ?>">
                                <span class="glyphicon form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="<?= Orphanage::NAME_FIELD ?>">Название:</label>
                            <div class="input-block">
                                <input type="text" name="<?= Orphanage::NAME_FIELD ?>" maxlength="<?= Orphanage::MAX_NAME_LENGTH ?>" class="form-control" id="<?= Orphanage::NAME_FIELD ?>" value="<?= $name ?>">
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста от <?= Orphanage::MIN_NAME_LENGTH ?> до <?= Orphanage::MAX_NAME_LENGTH ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="<?= Orphanage::DESCRIPTION_FIELD ?>">Описание:</label>
                            <div class="input-block">
                                <textarea class="form-control form-element" name="<?= Orphanage::DESCRIPTION_FIELD ?>" rows="5" id="<?= Orphanage::DESCRIPTION_FIELD ?>" ><?= $description ?></textarea>
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста не менее <?= Orphanage::MIN_DESCRIPTION_LENGTH?> символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="<?= Orphanage::CONTACT_INFO_FIELD ?>">Контактные данные:</label>
                            <div class="input-block">
                                <input type="text" name="<?= Orphanage::CONTACT_INFO_FIELD ?>" maxlength="<?= Orphanage::MAX_CONTACT_LENGTH ?>" class="form-control" id="<?= Orphanage::CONTACT_INFO_FIELD ?>" value="<?= $contactInfo ?>">
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста от <?= Orphanage::MIN_CONTACT_LENGTH ?> до <?= Orphanage::MAX_CONTACT_LENGTH ?> символов</span>
                            </div>
                        </div>
                        <div class="form-group button-row">
                            <input type="submit" class="btn btn-success success" value="Сохранить">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="label label-default">Отмена</span></a>
                            <?php if (isset($stock)): ?>
                                <a class="delete" href="<?php echo esc_url( home_url( '/delete-orphanage-controller.php?orphanage_id=' . $stock->orphanage_id ) ); ?>" onClick="return window.confirm('Вы дейтвительно хотите удалить?')">
                                    <span class="label label-danger">Удалить</span>
                                </a>
                            <?php endif;?>
                        </div>
                        <?php if (isset($stock)): ?>
                            <input type="hidden" name="<?= Orphanage::ID_FIELD ?>" id="<?= Orphanage::ID_FIELD ?>" value="<?= $stock->orphanage_id ?>">
                        <?php endif;?>
                    </div>
                </div>
            </form>
            <script src="<?php echo get_template_directory_uri(); ?>/js/validatefield.js"></script>
            <script>
                jQuery(document).ready(function($) {
                    $("form[name='orphanage_form']").submit(function(){
                        return validateTextField($('#<?= Orphanage::NAME_FIELD ?>'), <?= Orphanage::MIN_NAME_LENGTH ?>, <?= Orphanage::MAX_NAME_LENGTH ?>) &&
                            validateTextField($('#<?= Orphanage::DESCRIPTION_FIELD ?>'), <?= Orphanage::MIN_DESCRIPTION_LENGTH ?>, <?= Orphanage::MAX_DESCRIPTION_LENGTH ?>) &&
                            validateTextField($('#<?= Orphanage::CONTACT_INFO_FIELD ?>'), <?= Orphanage::MIN_CONTACT_LENGTH ?>, <?= Orphanage::MAX_CONTACT_LENGTH ?>) &&
                            validateImageUploadingField($('.kv-avatar .file-input')) &&
                            validateNumberField($('#<?= Orphanage::PRIORITY_FIELD ?>'), <?= OrphanagePriority::MIN_PRIORITY ?>, <?= OrphanagePriority::MAX_PRIORITY ?>);
                    });
                });
            </script>
        </div>
    </div>

<?php get_footer(); ?>