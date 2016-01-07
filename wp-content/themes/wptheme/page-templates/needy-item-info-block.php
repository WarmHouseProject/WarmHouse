<?php
    $page = isset($page) ? $page : 0;
?>
<div class="services-bottom">
    <div class="services-row">
        <?php foreach ($needyItems as $index => $needyItem): ?>
        <?php if ($index % 4 == 0 && $index != 0): ?>
        <div class="clearfix"></div>
    </div>
    <div class="services-row">
        <?php endif; ?>
        <div class="col-md-3 services-left">
            <div class="view fifth-effect">
                <a href="<?= esc_url( home_url( '/needy_info?needy_id=' .  $needyItem->needy_id . '&"needy_type=' . $needyItem->needy_type ) ); ?>" title="Подробная информация">
                    <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($needyItem->image_id) ?>" alt="<?= $needyItem->name ?>"/>
                </a>
            </div>
            <div class="s-btm <?php if (NeedyItemUtils::isItemSupportStatus($needyItem)): ?><?= NeedyStatus::getNeedyClassByStatuses($needyItem->status); ?><?php endif; ?>">
                <h4><?= $needyItem->name ?></h4>
                <div class="underline"></div>
                <p><?= $needyItem->short_description ?></p>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="clearfix"></div>
    </div>
    <?php if ($needyItemsCountPages > 0): ?>
    <div class="col-md-12">
        <ul class="pagination">
            <?php for ($index = 0; $index <= $needyItemsCountPages; ++$index): ?>
                <li class="page <?php if ($index == $page): ?><?= "active" ?><?php endif; ?>"><a href="javascript:void(0)"><?= $index + 1 ?></a></li>
            <?php endfor; ?>
        </ul>
    </div>
    <?php endif; ?>
</div>
