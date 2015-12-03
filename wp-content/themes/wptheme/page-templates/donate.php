<?php
/*
Template Name: Donation Form
*/

    require_once(ABSPATH . WPINC . '/lib/class-child-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-orphanage-db-utils.php');
    require_once(ABSPATH . WPINC . '/lib/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/class-donation-utils.php');

    $childId     = RequestHelper::getParameter("child_id");
    $orphanageId = RequestHelper::getParameter("orphanage_id");
    $child     = null;
    $orphanage = null;

    if ($childId)
    {
        $child = ChildDBUtils::getChildById($childId);
    }

    if ($orphanageId)
    {
        $orphanage = OrphanageDBUtils::getOrphanageById($orphanageId);
    }

    $paymentPurpose = DonationUtils::createPaymentPurpose($child, $orphanage);
    $paymentPurposeTranslit = DonationUtils::createTransliteratedPaymentPurpose($child, $orphanage);

    get_header();
?>
<div class="donate-form">
    <div class="container">
        <div class="form-group">
            <label><?php echo $paymentPurpose; ?></label>
            <div class="input-block">
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_donations">
                    <input type="hidden" name="business" value="Q8CHD2XYLYDQJ">
                    <input type="hidden" name="return" value="http://warmhouse-wp.local/thank-you/">
                    <input type="hidden" name="cancel_return" value="http://warmhouse-wp.local/">
                    <input type="hidden" name="item_name" value="<?= $paymentPurposeTranslit; ?>">
                    <input type="hidden" name="currency_code" value="RUB">
                    <input type="hidden" name="lc" value="RU">
                    <input type="image" src="<?= get_template_directory_uri() . '/images/donation.png' ?>" border="0" name="submit" alt="PayPal — более безопасный и легкий способ оплаты через Интернет!">
                    <img alt="" border="0" src="https://www.sandbox.paypal.com/ru_RU/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>