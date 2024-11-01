<?php
	if (!defined('ABSPATH'))
		exit;
?>
<div class="wrap">
	<h2><?php esc_html_e('Add Group', 'wabaapi_wa_alerts'); ?></h2>
	<form action="" method="post">
		<?php wp_nonce_field('wabaapi_update_group_nonce', 'wabaapi_update_group_nonce_field'); ?>
		<table>
			<tr>
				<td colspan="2"><h3><?php esc_html_e('Group Info:', 'wabaapi_wa_alerts'); ?></h3></td>
			</tr>
			<tr>
				<td><span class="label_td" for="wabaapi_notify_group_name"><?php esc_html_e('Name', 'wabaapi_wa_alerts'); ?>:</span></td>
				<td><input type="text" id="wabaapi_notify_group_name" name="wabaapi_notify_group_name" value="<?php echo esc_attr($get_group->name); ?>"/></td>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<a href="admin.php?page=wabaapi_wa_alerts_subscriber_groups" class="button"><?php esc_html_e('Back', 'wabaapi_wa_alerts'); ?></a>
					<input type="submit" class="button-primary" name="wp_update_group" value="<?php esc_html_e('Add', 'wabaapi_wa_alerts'); ?>"/>
				</td>
			</tr>
		</table>
	</form>
</div>