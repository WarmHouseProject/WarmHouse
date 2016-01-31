<?php
    require_once(ABSPATH . WPINC . '/lib/utils/view/class-needy-view-utils.php');

    $needyItems = NeedyViewUtils::prepareNeedyViewArray($needyItems);
    $page = isset($page) ? $page : 0;
?>
<div class="services-bottom">
    <div class="services-row">

        <?php foreach ($needyItems as $subNeedyItems): ?>
          <div class="col-md-3 services-left">
          <?php foreach ($subNeedyItems as $needyItem): ?>
            <div class="needy-item">
                <div class="view fifth-effect needy-image-container">
                    <div class="view">
                        <a href="<?= esc_url( home_url( '/needy_info?needy_id=' .  $needyItem->needy_id . '&"needy_type=' . $needyItem->needy_type ) ); ?>" title="Подробная информация">
                            <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($needyItem->image_id) ?>" alt="<?= $needyItem->name ?>"/>
                        </a>
                    </div>
                    <div href="\" class="view status-overlay <?php if (NeedyItemUtils::isItemSupportStatus($needyItem)): ?><?= NeedyStatus::getNeedyClassByStatuses($needyItem->status); ?><?php endif; ?>">
                        <a href="<?= esc_url( home_url( '/needy_info?needy_id=' .  $needyItem->needy_id . '&"needy_type=' . $needyItem->needy_type ) ); ?>" title="Подробная информация">
                            <img style="" src="<?php echo get_template_directory_uri(); ?>/images/urgent.png" alt="" />
                        </a>
                    </div>
                </div>
                <form class="s-btm <?php if (NeedyItemUtils::isItemSupportStatus($needyItem)): ?><?= NeedyStatus::getNeedyClassByStatuses($needyItem->status); ?><?php endif; ?>" action="/campaign/donate" method="post">
                    <h4><?= $needyItem->name ?></h4>
                    <div class="underline"></div>
                    <p class="short-info"><?= $needyItem->short_description ?></p>
                    <?php if ($needyItem->purpose): ?>
                      <p class="purpose"><span>Нужно: </span><?= $needyItem->purpose ?></p>
                    <?php endif; ?>
                    <input type="hidden" name="needy_type" value="<?= $needyItem->needy_type; ?>">
                    <input type="hidden" name="needy_id" value="<?= $needyItem->needy_id; ?>">
                    <button style="width:100%;" type="submit" class="btn btn-primary btn-send-email">Пожертвовать</button>
                </form>
            </div>
          <?php endforeach; ?>
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
