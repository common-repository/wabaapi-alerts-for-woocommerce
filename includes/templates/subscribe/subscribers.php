<?php
	if (!defined('ABSPATH'))
		exit;
	$reqPage = isset($_REQUEST['page']) ? sanitize_text_field($_REQUEST['page']) : '';
?>
<div class="wrap">
	<div class="wabaapi_top_image_logo"></div>
	<h2><?php esc_html_e('Subscribers', 'wabaapi_wa_alerts'); ?></h2>

	<div class="wabaapi_notifications-button-group">
		<a href="admin.php?page=wabaapi_wa_alerts_subscribers&action=add" class="button"><span class="dashicons dashicons-admin-users"></span> <?php esc_html_e('Add Subscriber', 'wabaapi_wa_alerts'); ?>
		</a>
		<a href="admin.php?page=wabaapi_wa_alerts_subscriber_groups" class="button"><span class="dashicons dashicons-category"></span> <?php esc_html_e('Manage Groups', 'wabaapi_wa_alerts'); ?>
		</a>
		<a href="admin.php?page=wabaapi_wa_alerts_subscribers&action=import" class="button"><span class="dashicons dashicons-yes"></span> <?php esc_html_e('Import Subscribers', 'wabaapi_wa_alerts'); ?>
		</a>
	</div>

	<form id="subscribers-filter" method="get">
		<input type="hidden" name="page" value="<?php echo !empty($reqPage) ? esc_attr($reqPage) : ''; ?>"/>
		<?php $list_table->search_box(esc_attr__('Search', 'wabaapi_wa_alerts'), 'search_id'); ?>
		<?php $list_table->display(); ?>
	</form>
</div>