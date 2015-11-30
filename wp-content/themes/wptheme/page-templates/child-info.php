<?php
/*
Template Name: Child Info
*/

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

require_once(ABSPATH . WPINC . '/lib/class-child-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/class-image-db-utils.php');
require_once(ABSPATH . WPINC . '/lib/class-request-helper.php');

$childId = RequestHelper::getParameter("child_id");
$child   = null;

if ($childId)
{
    $child = ChildDBUtils::getChildById($childId);
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
                            <?php if ($child->status == ChildStatus::URGENTLY_NEED_HELP): ?>
                                <img class="status-label" src="<?= get_template_directory_uri() . '/images/urgently.png' ?>" alt=""/>
                            <?php elseif ($child->status == ChildStatus::HELPED): ?>
                                <img class="status-label" src="<?= get_template_directory_uri() . '/images/helped.png' ?>" alt=""/>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (is_user_logged_in()): ?>
                        <div class="inner-container edit">
                            <a href="<?= esc_url( home_url( '/edit-child-page-controller.php?child_id=' . $child->child_id ) ); ?>"><span class="label label-warning">Редактировать</span></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-9">
                    <div class="inner-container heading">
                        <h2 class="head"><?= $child->name ?></h2>
                    </div>
                    <form class="inner-container heading" action="/donation/" method="post">
                        <div class="well short-description"><?= $child->short_description ?></div>
                        <div class="well well-sm contact-info"><?= $child->contact_info ?></div>
                        <button type="button" id="showLongDescriptionButton" class="btn btn-primary long-description">Читать больше</button>
                        <input type="hidden" name="child_id" value="<?= $childId; ?>">
                        <button type="submit" class="btn btn-success donate">Пожертвовать</button>
                        <div class="well well-lg collapse long-description" id="longDescription"><?= $child->long_description ?></div>
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

