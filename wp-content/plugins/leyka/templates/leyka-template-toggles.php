<?php if( !defined('WPINC') ) die;
/**
 * Leyka Template: Toggles
 * Description: Toggled options for each payment method
 **/
require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');

$active_pm = apply_filters('leyka_form_pm_order', leyka_get_pm_list(true));

$needyId   = RequestHelper::getParameter("needy_id");
$needyType = RequestHelper::getParameter("needy_type");

leyka_pf_submission_errors();?>

<div id="leyka-payment-form" class="leyka-tpl-toggles">
    <!-- <?php echo __("This donation form is created by Leyka WordPress plugin, created by Teplitsa of Social Technologies. If you are interested in some way, don't hesitate to write to us: support@te-st.ru", 'leyka');?> -->
<?php $counter = 0;

	foreach($active_pm as $i => $pm) {

	leyka_setup_current_pm($pm);
	$counter++;?>

<div class="leyka-payment-option toggle <?php if($counter == 1) echo 'toggled';?> <?php echo esc_attr($pm->full_id);?>">
<div class="leyka-toggle-trigger <?php echo count($active_pm) > 1 ? '' : 'toggle-inactive';?>">
    <?php echo leyka_pf_get_pm_label();?>
</div>
<div class="leyka-toggle-area">
<form class="leyka-pm-form" id="<?php echo leyka_pf_get_form_id();?>" action="<?php echo leyka_pf_get_form_action();?>" method="post">
	
	<div class="leyka-pm-fields">

    <?php echo leyka_pf_get_amount_field().(leyka_pf_get_hidden_fields(empty($campaign) ? false : $campaign->id));?>

	<input name="leyka_payment_method" value="<?php echo esc_attr($pm->full_id);?>" type="hidden">
	<input name="leyka_ga_payment_method" value="<?php echo esc_attr($pm->label);?>" type="hidden">
		<input type='hidden' name="leyka_needy_id" value="<?= $needyId ?>" />
		<input type='hidden' name="leyka_needy_type" value="<?= $needyType ?>" />
	<div class='leyka-user-data'>

	<?php echo leyka_pf_get_name_field().leyka_pf_get_email_field().leyka_pf_get_pm_fields();?>

	</div>

<?php echo leyka_pf_get_recurring_field().leyka_pf_get_agree_field().leyka_pf_get_submit_field();

	$icons = leyka_pf_get_pm_icons();	
	if($icons) {

		$list = array();
		foreach($icons as $i) {
			$list[] = "<li>{$i}</li>";
		}

		echo '<ul class="leyka-pm-icons cf">'.implode('', $list).'</ul>';
	}?>
	</div> <!-- .leyka-pm-fields -->	

<?php echo "<div class='leyka-pm-desc'>".apply_filters('leyka_the_content', leyka_pf_get_pm_description())."</div>"; ?>

</form>
</div>
</div>
<?php }?>

<?php if(leyka_options()->opt('show_campaign_sharing')) {
    leyka_share_campaign_block(empty($campaign) ? false : $campaign->id);
}

leyka_pf_footer();?>

</div><!-- #leyka-payment-form -->