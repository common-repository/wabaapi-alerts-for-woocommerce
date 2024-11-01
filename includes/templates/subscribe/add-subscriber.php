<?php
	if (!defined('ABSPATH'))
		exit;
?>
<div class="wrap">
	<h2><?php esc_html_e('Add New Subscriber', 'wabaapi_wa_alerts'); ?></h2>
	<form action="" method="post">
		<?php wp_nonce_field('wabaapi_add_subscribe_nonce', 'wabaapi_add_subscribe_nonce_field'); ?>
		<table>
			<tr>
				<td colspan="2"><h3><?php esc_html_e('Subscriber Info:', 'wabaapi_wa_alerts'); ?></h3></td>
			</tr>
			<tr>
				<td><span class="form-input" for="wabaapi_notify_subscribe_name"><?php esc_html_e('Name', 'wabaapi_wa_alerts'); ?>:</span></td>
				<td><input type="text" id="wabaapi_notify_subscribe_name" name="wabaapi_notify_subscribe_name" class="form-input" /></td>
			</tr>
			<tr>
				<td><span class="form-input" for="wabaapi_notify_subscribe_mobile"><?php esc_html_e('Mobile', 'wabaapi_wa_alerts'); ?>:</span></td>
				<td><input type="text" name="wabaapi_notify_subscribe_mobile" id="wabaapi_notify_subscribe_mobile" class="form-input" /></td>
				<td><span class="form-input">Add with country code</span></td>
			</tr>
			<?php if ($this->subscribe->get_groups()): ?>
					<tr>
						<td><span class="form-input" for="wabaapi_notify_group_name"><?php esc_html_e('Group', 'wabaapi_wa_alerts'); ?>:</span></td>
						<td>
							<select name="wabaapi_notify_group_name" id="wabaapi_notify_group_name" class="form-input">
								<?php foreach ($this->subscribe->get_groups() as $items): ?>
									<option value="<?php echo esc_attr($items->ID); ?>"><?php echo esc_html($items->name); ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
				<?php else: ?>
					<tr class="form-input">
						<td><span for="wabaapi_alerts_group_name"><?php esc_html_e('Group', 'wabaapi_wa_alerts'); ?>:</span></td>
						<td class="form-input"><?php echo sprintf(esc_html__('There is no group! <a href="%s">Add</a>', 'wabaapi_wa_alerts'),  esc_url('admin.php?page=wabaapi_wa_alerts_subscriber_groups')); ?></td>
					</tr>
			<?php endif; ?>
			<tr>
				<td colspan="2">
					<input type="hidden" name="wabaapi_add_subscribe_nonce" value="<?php echo wp_create_nonce('wabaapi_add_subscribe_nonce'); ?>" />
					<a style="margin-top:30px;margin-left:20px" href="admin.php?page=wabaapi_wa_alerts_subscribers" class="button"><?php esc_html_e('Back', 'wabaapi_wa_alerts'); ?></a>
					<input style="margin-top:30px" type="submit" class="button-primary" name="wp_add_subscribe" value="<?php esc_html_e('Add', 'wabaapi_wa_alerts'); ?>"/>
				</td>
			</tr>
		</table>
	</form>
</div>