<div class="services-bottom">
    <div class="services-row">
        <?php foreach ($needyItems as $index => $needyItem): ?>
        <?php if ($index % 4 == 0 && $index != 0): ?>
        <div class="clearfix"></div>
    </div>
    <div class="services-row">
        <?php endif; ?>
        <div class="col-md-3 services-left">
            <div class="view fifth-effect <?php if (NeedyItemUtils::isItemSupportStatus($needyItem)): ?><?= NeedyStatus::getNeedyClassByStatuses($needyItem->status); ?><?php endif; ?>">
                <a href="<?= esc_url( home_url( '/needy_info?needy_id=' .  $needyItem->needy_id . '&"needy_type=' . $needyItem->needy_type ) ); ?>" title="Подробная информация">
                    <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($needyItem->image_id) ?>" alt="<?= $needyItem->name ?>"/>
                </a>
                <div class="mask"></div>
            </div>
            <div class="s-btm">
                <h4><?= $needyItem->name ?></h4>
                <p><?= $needyItem->short_description ?></p>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="clearfix"></div>
    </div>
</div>
