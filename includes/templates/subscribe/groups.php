<?php
	if (!defined('ABSPATH'))
		exit;
	$reqPage = isset($_REQUEST['page']) ? sanitize_text_field($_REQUEST['page']) : '';
?>
<div class="wrap">
	<div class="wabaapi_top_image_logo"></div>
	<h2><?php esc_html_e('Groups', 'wabaapi_wa_alerts'); ?></h2>
	<p class="color-333">You can only send maximum 1000 mobile numbers from a group. Do not select multiple groups and kindly restrict per group to maximum 1000 numbers.</p>
	<div class="wabaapi_notifications-button-group">
		<a href="admin.php?page=wabaapi_wa_alerts_subscriber_groups&action=add" class="button"><span class="dashicons dashicons-groups"></span> <?php esc_html_e('Add Group', 'wabaapi_wa_alerts'); ?></a>
	</div>

	<form id="subscribers-filter" method="get">
		<input type="hidden" name="page" value="<?php echo !empty($reqPage) ? esc_attr($reqPage) : ''; ?>"/>
		<?php $list_table->search_box(esc_attr__('Search', 'wabaapi_wa_alerts'), 'search_id'); ?>
		<?php $list_table->display(); ?>
	</form>
</div>