<?php
/*
Template Name: Needy Info
*/

require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-type.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-child-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-orphanage-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/utils/db/class-image-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');

$needyId   = RequestHelper::getParameter("needy_id");
$needyType = RequestHelper::getParameter("needy_type");
$needyItem = null;
$editPageController = null;
$donateHiddenId = null;

if ($needyId && $needyType == NeedyType::CHILD)
{
    $needyItem = ChildDBUtils::getChildById($needyId);
    $editPageController = '/edit-child-page-controller.php?child_id=' . $needyId;
    $donateHiddenId = "child_id";
}
elseif ($needyId && $needyType == NeedyType::ORPHANAGE)
{
    $needyItem = OrphanageDBUtils::getOrphanageById($needyId);
    $editPageController = '/edit-orphanage-page-controller.php?orphanage_id=' . $needyId;
    $donateHiddenId = "orphanage_id";
}

get_header(); ?>

<?php if ($needyItem): ?>
    <div class="child-info">
        <div class="container">
            <div class="col">
                <div class="col-md-3">
                    <div class="inner-container image">
                        <div class="inner-image-block">
                            <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($needyItem->image_id) ?>" class="img-thumbnail child-image" alt="<?= $needyItem->name ?>">
                        </div>
                    </div>
                    <?php if (is_user_logged_in()): ?>
                        <div class="inner-container edit">
                            <a href="<?= esc_url( home_url( $editPageController ) ); ?>"><span class="label label-warning">Редактировать</span></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-9">
                    <div class="inner-container heading">
                        <h2 class="head"><?= $needyItem->name ?></h2>
                    </div>
                    <form class="inner-container heading" action="/donation/" method="post">
                        <div class="well short-description"><?= $needyItem->short_description ?></div>
                        <div class="well well-sm contact-info"><?= $needyItem->contact_info ?></div>
                        <button type="button" id="showLongDescriptionButton" class="btn btn-primary long-description">Читать больше</button>
                        <input type="hidden" name="<?= $donateHiddenId ?>" value="<?= $needyId; ?>">
                        <?php if (!isset($needyItem->status ) || $needyItem->status != NeedyStatus::HELPED): ?>
                            <button type="submit" class="btn btn-success donate">Пожертвовать</button>
                        <?php endif; ?>
                        <div class="well well-lg collapse long-description" id="longDescription"><?= $needyItem->long_description ?></div>
                    </form>
                    <script>
                        jQuery(document).ready(function($) {
                            $('#showLongDescriptionButton').click(function(){
                                $('#longDescription').slideToggle( "slow");
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>

