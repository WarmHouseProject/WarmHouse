<div class="container orphanage">
    <?php foreach ($orphanages as $index => $orphanage): ?>
        <div class="orphanage-info">
            <div class="col">
                <div class="col-sm-3">
                    <div class="inner-container image">
                        <div class="inner-image-block">
                            <img src="<?= get_site_url() . ImageDBUtils::getImageLinkByImageId($orphanage->image_id) ?>" class="img-thumbnail orphanage-image" alt="<?= $orphanage->name ?>">
                        </div>
                    </div>
                    <?php if (is_user_logged_in()): ?>
                        <div class="inner-container edit">
                            <a href="<?= esc_url( home_url( '/edit-orphanage-page-controller.php?orphanage_id=' . $orphanage->orphanage_id ) ); ?>"><span class="label label-warning">Редактировать</span></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-9">
                    <div class="inner-container heading">
                        <h2 class="head"><?= $orphanage->name ?></h2>
                    </div>
                    <div class="inner-container heading">
                        <div class="well short-description"><?= $orphanage->description ?></div>
                        <div class="well well-sm contact-info"><?= $orphanage->contact_info ?></div>
                        <button type="button" class="btn btn-success donate">Пожертвовать</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>