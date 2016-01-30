<?php
/*
Template Name: Child Form
*/

    require_once(ABSPATH . WPINC . '/lib/model/child/class-child.php');
    require_once(ABSPATH . WPINC . '/lib/model/child/class-child-status.php');
    require_once(ABSPATH . WPINC . '/lib/model/child/class-child-priority.php');

    $avatar           = "";
    $name             = "";
    $childStatus      = ChildStatus::DEFAULT_NEEDY_STATUS;
    $childPriority    = ChildPriority::DEFAULT_PRIORITY;
    $shortDescription = "";
    $longDescription  = "";
    $purpose          = "";
    $contactInfo      = "";

    $formRequestUrl = "/child-form-controller.php";
    if (isset($child))
    {
        $avatar           = "<img src='" . get_site_url() . ImageDBUtils::getImageLinkByImageId($child->image_id) . "' class='file-preview-image' alt='avatar' title='avatar'>";
        $name             = $child->name;
        $childStatus      = $child->status;
        $childPriority    = $child->priority;
        $shortDescription = $child->short_description;
        $longDescription  = $child->long_description;
        $contactInfo      = $child->contact_info;
        $purpose          = $child->purpose;

        $formRequestUrl = "/edit-child-controller.php";
    }

    $childStatusesText = ChildStatus::getNeedyStatusesText();
    $childStatuses     = implode(",", ChildStatus::getNeedyStatuses());

    get_header();
?>

<div class="child-form">
    <div class="container">
        <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
        <form name="child_form" action="<?= esc_url( home_url( $formRequestUrl ) ); ?>" method="post" enctype="multipart/form-data">
            <div class="col">
                <div class="col-md-3">
                    <div class="form-group kv-avatar">
                        <div class="alert alert-danger" style="display: none;">Аватар не выбран.</div>
                        <input id="<?= Child::AVATAR_FIELD ?>" name="<?= Child::AVATAR_FIELD ?>" type="file" class="file-loading">
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
                        <label for="<?= Child::STATUS_FIELD ?>">Статус:</label>
                        <div class="input-block">
                            <select class="form-control" name="<?= Child::STATUS_FIELD ?>" id="<?= Child::STATUS_FIELD ?>">
                                <?php foreach ($childStatusesText as $key => $value):?>
                                    <option value="<?= $key ?>" <?php if ($key == $childStatus): ?>selected<?php endif; ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?= Child::PRIORITY_FIELD ?>">Приоритет:</label>
                        <div class="input-block">
                            <input type="number" name="<?= Child::PRIORITY_FIELD ?>" min="<?= ChildPriority::MIN_PRIORITY ?>" max="<?= ChildPriority::MAX_PRIORITY ?>" class="form-control" id="<?= Child::PRIORITY_FIELD ?>" value="<?= $childPriority ?>">
                            <span class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="<?= Child::NAME_FIELD ?>">Имя:</label>
                        <div class="input-block">
                            <input type="text" name="<?= Child::NAME_FIELD ?>" maxlength="<?= Child::MAX_NAME_LENGTH ?>" class="form-control" id="<?= Child::NAME_FIELD ?>" value="<?= $name ?>">
                            <span class="glyphicon form-control-feedback"></span>
                            <span class="error-message">допустимая длина текста от <?= Child::MIN_NAME_LENGTH ?> до <?= Child::MAX_NAME_LENGTH ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?= Child::SHORT_DESCRIPTION_FIELD ?>">Краткое описание:</label>
                        <div class="input-block">
                            <textarea class="form-control form-element" name="<?= Child::SHORT_DESCRIPTION_FIELD ?>" rows="3" id="<?= Child::SHORT_DESCRIPTION_FIELD ?>" ><?= $shortDescription ?></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <span class="error-message">допустимая длина текста не менее <?= Child::MIN_SHORT_DESCRIPTION_LENGTH?> символов</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?= Child::LONG_DESCRIPTION_FIELD ?>">Полное описание:</label>
                        <div class="input-block">
                            <textarea class="form-control form-element" name="<?= Child::LONG_DESCRIPTION_FIELD ?>" rows="7" id="<?= Child::LONG_DESCRIPTION_FIELD ?>"><?= $longDescription ?></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <span class="error-message">допустимая длина текста не менее <?= Child::MIN_LONG_DESCRIPTION_LENGTH ?> символов</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?= Child::PURPOSE_FIELD ?>">Нужно:</label>
                        <div class="input-block">
                            <input type="text" name="<?= Child::PURPOSE_FIELD ?>" maxlength="<?= Child::MAX_PURPOSE_LENGTH ?>" class="form-control" id="<?= Child::PURPOSE_FIELD ?>" value="<?= $purpose ?>">
                            <span class="glyphicon form-control-feedback"></span>
                            <span class="error-message">допустимая длина текста от <?= Child::MIN_PURPOSE_LENGTH ?> до <?= Child::MAX_PURPOSE_LENGTH ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?= Child::CONTACT_INFO_FIELD ?>">Контактные данные:</label>
                        <div class="input-block">
                            <input type="text" name="<?= Child::CONTACT_INFO_FIELD ?>" maxlength="<?= Child::MAX_CONTACT_LENGTH ?>" class="form-control" id="<?= Child::CONTACT_INFO_FIELD ?>" value="<?= $contactInfo ?>">
                            <span class="glyphicon form-control-feedback"></span>
                            <span class="error-message">допустимая длина текста от <?= Child::MIN_CONTACT_LENGTH ?> до <?= Child::MAX_CONTACT_LENGTH ?> символов</span>
                        </div>
                    </div>
                    <div class="form-group button-row">
                        <input type="submit" class="btn btn-success success" value="Сохранить">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="label label-default">Отмена</span></a>
                        <?php if (isset($child)): ?>
                            <a class="delete" href="<?php echo esc_url( home_url( '/delete-child-controller.php?child_id=' . $child->child_id ) ); ?>" onClick="return window.confirm('Вы дейтвительно хотите удалить?')">
                                <span class="label label-danger">Удалить</span>
                            </a>
                        <?php endif;?>
                    </div>
                    <?php if (isset($child)): ?>
                        <input type="hidden" name="<?= Child::ID_FIELD ?>" id="<?= Child::ID_FIELD ?>" value="<?= $child->child_id ?>">
                    <?php endif;?>
                </div>
            </div>
        </form>
        <script src="<?php echo get_template_directory_uri(); ?>/js/validatefield.js"></script>
        <script>
            jQuery(document).ready(function($) {
                $("form[name='child_form']").submit(function(){
                    return validateTextField($('#<?= Child::NAME_FIELD ?>'), <?= Child::MIN_NAME_LENGTH ?>, <?= Child::MAX_NAME_LENGTH ?>) &&
                           validateTextField($('#<?= Child::SHORT_DESCRIPTION_FIELD ?>'), <?= Child::MIN_SHORT_DESCRIPTION_LENGTH ?>, <?= Child::MAX_SHORT_DESCRIPTION_LENGTH ?>) &&
                           validateTextField($('#<?= Child::LONG_DESCRIPTION_FIELD ?>'), <?= Child::MIN_LONG_DESCRIPTION_LENGTH ?>, <?= Child::MAX_LONG_DESCRIPTION_LENGTH ?>) &&
                           validateTextField($('#<?= Child::PURPOSE_FIELD ?>'), <?= Child::MIN_PURPOSE_LENGTH ?>, <?= Child::MAX_PURPOSE_LENGTH ?>) &&
                           validateTextField($('#<?= Child::CONTACT_INFO_FIELD ?>'), <?= Child::MIN_CONTACT_LENGTH ?>, <?= Child::MAX_CONTACT_LENGTH ?>) &&
                           validateImageUploadingField($('.kv-avatar .file-input')) &&
                           validateSelectField($('#<?= Child::STATUS_FIELD ?>'), [<?= $childStatuses ?>]) &&
                           validateNumberField($('#<?= Child::PRIORITY_FIELD ?>'), <?= ChildPriority::MIN_PRIORITY ?>, <?= ChildPriority::MAX_PRIORITY ?>);
                });
            });
        </script>
    </div>
</div>
<?php get_footer(); ?>
