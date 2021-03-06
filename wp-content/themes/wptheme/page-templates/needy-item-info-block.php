<?php
    require_once(ABSPATH . WPINC . '/lib/utils/view/class-needy-view-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-needy-item-settings-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/db/class-needy-stat-db-utils.php');

    $needyItems = NeedyViewUtils::prepareNeedyViewArray($needyItems);
    $page = isset($page) ? $page : 0;
?>
<div class="services-bottom">
    <div class="services-row">
        <?php foreach ($needyItems as $key => $subNeedyItems): ?>
          <div class="col-md-3 services-left <? if ($key >2): ?>float_right<? endif;?>">
          <?php foreach ($subNeedyItems as $needyItem): ?>
            <div class="needy-item">
                <div class="view fifth-effect needy-image-container">
                    <div class="view">
                        <a href="<?= esc_url( home_url( '/needy_info?needy_id=' .  $needyItem->needy_id . '&"needy_type=' . $needyItem->needy_type ) ); ?>" title="Подробная информация">
                            <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($needyItem->image_id) ?>" alt="<?= $needyItem->name ?>"/>
                        </a>
                    </div>
                    <div class="view status-overlay <?php if (NeedyItemUtils::isItemSupportStatus($needyItem)): ?><?= NeedyStatus::getNeedyClassByStatuses($needyItem->status); ?><?php endif; ?>">
                        <a href="<?= esc_url( home_url( '/needy_info?needy_id=' .  $needyItem->needy_id . '&"needy_type=' . $needyItem->needy_type ) ); ?>" title="Подробная информация">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/urgent.png" alt="" />
                        </a>
                    </div>
                </div>
                <form class="s-btm <?php if (NeedyItemUtils::isItemSupportStatus($needyItem)): ?><?= NeedyStatus::getNeedyClassByStatuses($needyItem->status); ?><?php endif; ?>" action="/campaign/donate" method="post">
                    <h4><?= $needyItem->name ?></h4>
                    <div class="underline"></div>
                    <p class="short-info"><?= $needyItem->short_description ?></p>
                    <?php if ($needyItem->purpose && $needyItem->status != NeedyStatus::HELPED): ?>
                      <p class="purpose"><span>Нужно: </span><?= $needyItem->purpose ?></p>
                    <?php endif; ?>

                    <?php if (NeedyItemSettingsDBUtils::isSetShowNeedyItemStat($needyItem->needy_id, $needyItem->needy_type)): ?>
                        <?php
                            $collected = NeedyStatDBUtils::getNeedyItemStat($needyItem->needy_id, $needyItem->needy_type);
                            $addition  = NeedyItemSettingsDBUtils::getAdditionAmount($needyItem->needy_id, $needyItem->needy_type);
                            $result = $collected->amount + $addition->addition_amount;
                        ?>
                        <p class="collected"><span>Собрано: </span><?= intval($result) ?> руб. <span class="count-donate"><img src="<?php echo get_template_directory_uri(); ?>/images/count_donate.png" alt="" /><?= intval($collected->count) ?></span></p>
                    <?php endif; ?>
                    
                    <input type="hidden" name="needy_type" value="<?= $needyItem->needy_type; ?>">
                    <input type="hidden" name="needy_id" value="<?= $needyItem->needy_id; ?>">
                    <button type="submit" class="btn btn-primary">Пожертвовать</button>
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
                <li class="page <?php if ($index == $page): ?><?= "active" ?><?php endif; ?>"><a href="javascript:void(0);"><?= $index + 1 ?></a></li>
            <?php endfor; ?>
        </ul>
    </div>
    <?php endif; ?>
</div>
