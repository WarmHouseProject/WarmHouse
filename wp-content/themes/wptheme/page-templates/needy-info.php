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
$child = null;
$editPageController = null;
$donateHiddenId = null;

if ($needyId && $needyType == NeedyType::CHILD)
{
    $child = ChildDBUtils::getChildById($needyId);
    $editPageController = '/edit-child-page-controller.php?child_id=' . $needyId;
    $donateHiddenId = "child_id";
}
elseif ($needyId && $needyType == NeedyType::ORPHANAGE)
{
    $child = OrphanageDBUtils::getOrphanageById($needyId);
    $editPageController = '/edit-orphanage-page-controller.php?orphanage_id=' . $needyId;
    $donateHiddenId = "orphanage_id";
}

get_header(); ?>

<?php if ($child): ?>
    <div class="child-info">
        <div class="container">
            <div class="col">
                <div class="col-md-3">
                    <div class="inner-container image">
                        <div class="inner-image-block">
                            <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($child->image_id) ?>" class="img-thumbnail child-image" alt="<?= $child->name ?>">
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
                        <h2 class="head"><?= $child->name ?></h2>
                    </div>
                    <form class="inner-container heading" action="/campaign/donate  " method="post">
                        <div class="well short-description"><?= $child->short_description ?></div>
                        <div class="well well-sm contact-info"><?= $child->contact_info ?></div>
                        <input type="hidden" name="<?= $donateHiddenId ?>" value="<?= $needyId; ?>">
                        <?php if (!isset($child->status ) || $child->status != NeedyStatus::HELPED): ?>
                            <button type="submit" class="btn btn-success donate">Пожертвовать</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="well well-lg long-description" id="longDescription"><?= $child->long_description ?></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>

