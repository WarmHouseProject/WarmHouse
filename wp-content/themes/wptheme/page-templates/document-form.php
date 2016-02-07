<?php
/*
Template Name: Document Form
*/

    require_once(ABSPATH . WPINC . '/lib/model/document/class-document-item.php');

    $title = "";
    $info  = "";

    $formRequestUrl = "/add-document-controller.php";
    if (isset($document))
    {
        $title = $document->title;
        $info  = $document->info;

        $formRequestUrl = "/edit-document-controller.php";
    }

    get_header();
?>

    <div class="child-form document">
        <div class="container">
            <form name="document_form" action="<?= esc_url( home_url( $formRequestUrl ) ); ?>" method="post" enctype="multipart/form-data">
                <div class="col">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="<?= DocumentItem::TITLE_FIELD ?>">Заголовок:</label>
                            <div class="input-block">
                                <input type="text" name="<?= DocumentItem::TITLE_FIELD ?>" maxlength="<?= DocumentItem::MAX_TITLE_LENGTH ?>" class="form-control" id="<?= DocumentItem::TITLE_FIELD ?>" value="<?= $title ?>">
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста от <?= DocumentItem::MIN_TITLE_LENGTH ?> до <?= DocumentItem::MAX_TITLE_LENGTH ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="<?= DocumentItem::INFO_FIELD ?>">Полное описание:</label>
                            <div class="input-block">
                                <textarea class="form-control form-element" name="<?= DocumentItem::INFO_FIELD ?>" rows="7" id="<?= DocumentItem::INFO_FIELD ?>"><?= $info ?></textarea>
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="error-message">допустимая длина текста не менее <?= DocumentItem::MIN_INFO_LENGTH ?> символов</span>
                            </div>
                        </div>
                        <div class="form-group button-row">
                            <input type="submit" class="btn btn-success success" value="Сохранить">
                            <a href="<?php echo esc_url( get_site_url() . '/projects' ); ?>"><span class="label label-default">Отмена</span></a>
                            <?php if (isset($document)): ?>
                                <a class="delete" href="<?php echo esc_url( home_url( '/delete-document-controller.php?' . DocumentItem::ID_FIELD . '=' . $document->document_id . "&" . DocumentItem::DOCUMENT_TYPE . '=' . $document->document_type) ); ?>" onClick="return window.confirm('Вы дейтвительно хотите удалить?')">
                                    <span class="label label-danger">Удалить</span>
                                </a>
                            <?php endif;?>
                        </div>
                        <?php if (isset($document)): ?>
                            <input type="hidden" name="<?= DocumentItem::ID_FIELD ?>" id="<?= DocumentItem::ID_FIELD ?>" value="<?= $document->document_id ?>">
                            <input type="hidden" name="<?= DocumentItem::DOCUMENT_TYPE ?>" id="<?= DocumentItem::DOCUMENT_TYPE ?>" value="<?= $document->document_type ?>">
                        <?php elseif(isset($documentType)): ?>
                            <input type="hidden" name="<?= DocumentItem::DOCUMENT_TYPE ?>" id="<?= DocumentItem::DOCUMENT_TYPE ?>" value="<?= $documentType ?>">
                        <?php endif;?>
                    </div>
                </div>
            </form>
            <script src="<?php echo get_template_directory_uri(); ?>/js/validatefield.js"></script>
            <script>
                jQuery(document).ready(function($) {
                    $("form[name='document_form']").submit(function(){
                        return validateTextField($('#<?= DocumentItem::TITLE_FIELD ?>'), <?= DocumentItem::MIN_TITLE_LENGTH ?>, <?= DocumentItem::MAX_TITLE_LENGTH ?>) &&
                               validateTextField($('#<?= DocumentItem::INFO_FIELD ?>'), <?= DocumentItem::MIN_INFO_LENGTH ?>, <?= DocumentItem::MAX_INFO_LENGTH ?>);
                    });
                });
            </script>
        </div>
    </div>

<?php get_footer(); ?>