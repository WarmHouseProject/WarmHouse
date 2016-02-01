<?php
/*
Template Name: Needy Info
*/

require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-type.php');
require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-status.php');
require_once(ABSPATH . WPINC . '/lib/utils/class-needy-item-utils.php');
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
    <div class="child-info <?php if (NeedyItemUtils::isItemSupportStatus($child)): ?><?= NeedyStatus::getNeedyClassByStatuses($child->status); ?><?php endif; ?>">
        <div class="container">
            <div class="col">
                <div class="col-md-3">
                    <?php if (is_user_logged_in()): ?>
                        <div class="inner-container edit">
                            <a href="<?= esc_url( home_url( $editPageController ) ); ?>"><span class="label label-warning">Редактировать</span></a>
                        </div>
                    <?php endif; ?>
                    <div class="inner-container image">
                        <div class="inner-image-block">
                            <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($child->image_id) ?>" class="img-thumbnail child-image" alt="<?= $child->name ?>">
                        </div>
                        <div class="view status-overlay <?php if (NeedyItemUtils::isItemSupportStatus($child)): ?><?= NeedyStatus::getNeedyClassByStatuses($child->status); ?><?php endif; ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/urgent.png" alt="<?= $child->name ?>" />
                        </div>
                    </div>
                        <?php if ($child->purpose): ?>
                            <div class="text-container">
                                <span>Нужно: </span><span class="purpose"><?= $child->purpose ?></span>
                            </div>
                            <div class="underline"></div>
                        <?php endif; ?>
                        <div class="contact-info text-container"><?= $child->contact_info ?></div>
                        <input type="hidden" name="<?= $donateHiddenId ?>" value="<?= $needyId; ?>">
                        <input type="hidden" name="needy_type" value="<?= $needyType; ?>">
                        <input type="hidden" name="needy_id" value="<?= $needyId; ?>">
                        <?php if (!isset($child->status ) || $child->status != NeedyStatus::HELPED): ?>
                            <button type="submit" class="btn btn-primary">Пожертвовать</button>
                        <?php endif; ?>
                    </form>
                </div>
                <div class="col-md-9">
                    <div class="inner-container heading">
                        <h2 class="head"><?= $child->name ?></h2>
                    </div>
                    <div class="text-container long-description" id="longDescription"><?= NeedyItemUtils::storedTextToHTML($child->long_description) ?></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>

