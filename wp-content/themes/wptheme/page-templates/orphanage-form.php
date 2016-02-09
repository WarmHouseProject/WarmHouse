<?php
/*
Template Name: Orphanage Form
*/

    require_once(ABSPATH . WPINC . '/lib/model/orphanage/class-orphanage.php');
    require_once(ABSPATH . WPINC . '/lib/model/orphanage/class-orphanage-priority.php');
    require_once(ABSPATH . WPINC . '/lib/model/orphanage_settings/class-orphanage-settings.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-needy-item-settings-db-utils.php');

    $avatar            = "";
    $name              = "";
    $orphanagePriority = OrphanagePriority::DEFAULT_PRIORITY;
    $shortDescription  = "";
    $longDescription   = "";
    $purpose           = "";
    $contactInfo       = "";
    $showStat          = false;

    $formRequestUrl = "/add-orphanage-controller.php";
    if (isset($orphanage))
    {
        $avatar            = "<img src='" . get_site_url() . ImageDBUtils::getImageLinkByImageId($orphanage->image_id) . "' class='file-preview-image' alt='avatar' title='avatar'>";
        $name              = $orphanage->name;
        $orphanagePriority = $orphanage->priority;
        $shortDescription  = $orphanage->short_description;
        $longDescription   = $orphanage->long_description;
        $contactInfo       = $orphanage->contact_info;
        $purpose           = $orphanage->purpose;
        $showStat          = NeedyItemSettingsDBUtils::isSetShowOrphanageStat($orphanage->orphanage_id);

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
                            <label for="<?= Orphanage::SHORT_DESCRIPTION_FIELD ?>">Краткое описание:</label>
                            <div class="input-block">
                                <textarea class="form-control form-element" name="<?= Orphanage::SHORT_DESCRIPTION_FIELD ?>" rows="5" id="<?= Orphanage::SHORT_DESCRIPTION_FIELD ?>" ><?= $shortDescription ?></textarea>
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста не менее <?= Orphanage::MIN_SHORT_DESCRIPTION_LENGTH?> символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="<?= Orphanage::LONG_DESCRIPTION_FIELD ?>">Полное описание:</label>
                            <div class="input-block">
                                <textarea class="form-control form-element" name="<?= Orphanage::LONG_DESCRIPTION_FIELD ?>" rows="7" id="<?= Orphanage::LONG_DESCRIPTION_FIELD ?>"><?= $longDescription ?></textarea>
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста не менее <?= Orphanage::MIN_LONG_DESCRIPTION_LENGTH ?> символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="<?= Orphanage::PURPOSE_FIELD ?>">Нужно:</label>
                            <div class="input-block">
                                <input type="text" name="<?= Orphanage::PURPOSE_FIELD ?>" maxlength="<?= Orphanage::MAX_PURPOSE_LENGTH ?>" class="form-control" id="<?= Orphanage::PURPOSE_FIELD ?>" value="<?= $purpose ?>">
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста от <?= Orphanage::MIN_PURPOSE_LENGTH ?> до <?= Orphanage::MAX_PURPOSE_LENGTH ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-block">
                                <input name="<?= OrphanageSettings::SHOW_STAT_FIELD ?>" id ="<?= OrphanageSettings::SHOW_STAT_FIELD ?>" type="checkbox" value="<?= intval($showStat) ?>"<?php if ($showStat): ?> checked="checked"<?php endif; ?>><label class="checkbox-label" for="<?= OrphanageSettings::SHOW_STAT_FIELD ?>">Показывать статистику</label>
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
                            <?php if (isset($orphanage)): ?>
                                <a class="delete" href="<?php echo esc_url( home_url( '/delete-orphanage-controller.php?orphanage_id=' . $orphanage->orphanage_id ) ); ?>" onClick="return window.confirm('Вы дейтвительно хотите удалить?')">
                                    <span class="label label-danger">Удалить</span>
                                </a>
                            <?php endif;?>
                        </div>
                        <?php if (isset($orphanage)): ?>
                            <input type="hidden" name="<?= Orphanage::ID_FIELD ?>" id="<?= Orphanage::ID_FIELD ?>" value="<?= $orphanage->orphanage_id ?>">
                        <?php endif;?>
                    </div>
                </div>
            </form>
            <script src="<?php echo get_template_directory_uri(); ?>/js/validatefield.js"></script>
            <script>
                jQuery(document).ready(function($) {
                    $("#<?= OrphanageSettings::SHOW_STAT_FIELD ?>").click(function(){
                        if ($(this).prop( "checked" )) {
                            $(this).val("1");
                        }
                        else {
                            $(this).val("0");
                        }
                    });

                    $("form[name='orphanage_form']").submit(function(){
                        return validateTextField($('#<?= Orphanage::NAME_FIELD ?>'), <?= Orphanage::MIN_NAME_LENGTH ?>, <?= Orphanage::MAX_NAME_LENGTH ?>) &&
                            validateTextField($('#<?= Orphanage::SHORT_DESCRIPTION_FIELD ?>'), <?= Orphanage::MIN_SHORT_DESCRIPTION_LENGTH ?>, <?= Orphanage::MAX_SHORT_DESCRIPTION_LENGTH ?>) &&
                            validateTextField($('#<?= Orphanage::LONG_DESCRIPTION_FIELD ?>'), <?= Orphanage::MIN_LONG_DESCRIPTION_LENGTH ?>, <?= Orphanage::MAX_LONG_DESCRIPTION_LENGTH ?>) &&
                            validateTextField($('#<?= Orphanage::PURPOSE_FIELD ?>'), <?= Orphanage::MIN_PURPOSE_LENGTH ?>, <?= Orphanage::MAX_PURPOSE_LENGTH ?>) &&
                            validateTextField($('#<?= Orphanage::CONTACT_INFO_FIELD ?>'), <?= Orphanage::MIN_CONTACT_LENGTH ?>, <?= Orphanage::MAX_CONTACT_LENGTH ?>) &&
                            validateImageUploadingField($('.kv-avatar .file-input')) &&
                            validateNumberField($('#<?= Orphanage::PRIORITY_FIELD ?>'), <?= OrphanagePriority::MIN_PRIORITY ?>, <?= OrphanagePriority::MAX_PRIORITY ?>);
                    });
                });
            </script>
        </div>
    </div>

<?php get_footer(); ?>