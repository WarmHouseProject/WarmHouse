<?php
    global $childs;
?>

<div class="services-bottom">
    <div class="services-row">
        <?php foreach ($childs as $index => $child): ?>
        <?php if ($index % 4 == 0 && $index != 0): ?>
        <div class="clearfix"></div>
    </div>
    <div class="services-row">
        <?php endif; ?>
        <div class="col-md-3 services-left">
            <div class="view fifth-effect">
                <a href="<?= esc_url( home_url( '/child_info?child_id=<' .  $child->child_id ) ); ?>" title="Подробная информация">
                    <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($child->image_id) ?>" alt="<?= $child->name ?>"/>
                    <?php if ($child->status == ChildStatus::URGENTLY_NEED_HELP): ?>
                        <img class="status-label" src="<?= get_template_directory_uri() . '/images/urgently.png' ?>" alt=""/>
                    <?php elseif ($child->status == ChildStatus::HELPED): ?>
                        <img class="status-label" src="<?= get_template_directory_uri() . '/images/helped.png' ?>" alt=""/>
                    <?php endif; ?>
                </a>
                <div class="mask"></div>
            </div>
            <div class="s-btm">
                <h4><?= $child->name ?></h4>
                <p><?= $child->short_description ?></p>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="clearfix"></div>
    </div>
</div>
