<?php
/*
Template Name: Projects Form
*/

require_once(ABSPATH . WPINC . '/lib/model/document/class-document-item.php');
require_once(ABSPATH . WPINC . '/lib/model/document/class-document-type.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-document-item-db-utils.php');

$grants   = DocumentItemDBUtils::getAllGrants();
$programs = DocumentItemDBUtils::getAllPrograms();

get_header();
?>
<div class="projects information_block">
    <div class="container">
        <div class="col-md-6">
            <?php if (is_user_logged_in()): ?>
                <div class="btn-group float-left add-buttons">
                    <a href="<?= get_site_url(); ?>/add-document-page-controller.php?<?= DocumentItem::DOCUMENT_TYPE . '=' . DocumentType::GRANT ?>"><span class="btn btn-primary">Добавить проект</span></a>
                    <a href="<?= get_site_url(); ?>/add-document-page-controller.php?<?= DocumentItem::DOCUMENT_TYPE . '=' . DocumentType::PROGRAM ?>"><span class="btn btn-primary">Добавить программу</span></a>
                </div>
                <div class="clearfix"></div>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6 left-column">
            <h2 class="header green_text">Проекты</h2>
            <ul class="list">
                <?php foreach($grants as $grant): ?>
                  <li>
                      <a class="blue_text pop2 x-content" data-bpopup="<?= $grant->info ?>" href="javascript:void(0)"><?= $grant->title ?></a>
                      <?php if (is_user_logged_in()): ?>
                          <a href="<?= get_site_url() . "/edit-document-page-controller.php?" . DocumentItem::ID_FIELD . '=' . $grant->grant_id . "&" . DocumentItem::DOCUMENT_TYPE . '=' . DocumentType::GRANT ?>" class="edit-document">
                              <span class="glyphicon glyphicon-pencil"></span>
                          </a>
                      <?php endif; ?>
                  </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-6 right-column">
            <h2 class="header green_text">Программы</h2>
            <ul class="list" >
                <?php foreach($programs as $program): ?>
                    <li>
                        <a class="blue_text pop2 x-content" data-bpopup="<?= $program->info ?>" href="javascript:void(0)"><?= $program->title ?></a>
                        <?php if (is_user_logged_in()): ?>
                            <a href="<?= get_site_url() . "/edit-document-page-controller.php?" . DocumentItem::ID_FIELD . '=' . $program->program_id . "&" . DocumentItem::DOCUMENT_TYPE . '=' . DocumentType::PROGRAM ?>" class="edit-document">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div id="element_to_pop_up">
            <span class="button b-close">
                <span>X</span>
            </span>
            <div class="content"></div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                $('.pop2').bind('click', function(e) {

                    e.preventDefault();

                    var self = $(this)
                        , content = $('.content');
                    $('#element_to_pop_up').bPopup({
                            onOpen: function() {
                                content.html(self.data('bpopup') || '');
                            },
                            onClose: function() {
                                content.empty();
                            }

                    });
                })
            });
        </script>
    </div>
</div>

<?php get_footer(); ?>


