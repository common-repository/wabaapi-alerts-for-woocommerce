<?php
	if (!defined('ABSPATH'))
		exit;
?>
<div class="wrap">
	<h2><?php esc_html_e('Edit Subscriber', 'wabaapi_wa_alerts'); ?></h2>
	<form action="" method="post">
		<?php wp_nonce_field('wabaapi_update_subscribe_nonce', 'wabaapi_update_subscribe_nonce_field'); ?>
		<table>
			<tr>
				<td colspan="2"><h3><?php esc_html_e('Subscriber Info:', 'wabaapi_wa_alerts'); ?></h3></td>
			</tr>
			<tr>
				<td><span class="label_td" for="wabaapi_notify_subscribe_name"><?php esc_html_e('Name', 'wabaapi_wa_alerts'); ?>:</span></td>
				<td><input type="text" id="wabaapi_notify_subscribe_name" name="wabaapi_notify_subscribe_name" value="<?php echo esc_attr($get_subscribe->name); ?>"/></td>
			</tr>
			<tr>
				<td><span class="label_td" for="wabaapi_notify_subscribe_mobile"><?php esc_html_e('Mobile', 'wabaapi_wa_alerts'); ?>:</span></td>
				<td><input type="text" name="wabaapi_notify_subscribe_mobile" id="wabaapi_notify_subscribe_mobile" value="<?php echo esc_attr($get_subscribe->mobile); ?>" class="code"/></td>
			</tr>
			<?php if ($this->subscribe->get_groups()): ?>
					<tr>
						<td><span class="label_td" for="wabaapi_notify_group_name"><?php esc_html_e('Group', 'wabaapi_wa_alerts'); ?>:</span></td>
						<td>
							<select name="wabaapi_notify_group_name" id="wabaapi_notify_group_name">
								<?php foreach ($this->subscribe->get_groups() as $items): ?>
									<option value="<?php echo esc_attr($items->ID); ?>" <?php selected($get_subscribe->group_ID, $items->ID); ?>>
										<?php echo esc_html($items->name); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
				<?php else: ?>
					<tr>
						<td><span class="label_td" for="wabaapi_alerts_group_name"><?php esc_html_e('Group', 'wabaapi_wa_alerts'); ?>:</span></td>
						<td><?php echo sprintf(esc_html__('There is no group! <a href="%s">Add</a>', 'wabaapi_wa_alerts'), esc_url('admin.php?page=wabaapi_wa_alerts_subscriber_groups')); ?></td>
					</tr>
			<?php endif; ?>
			<tr>
				<td colspan="2">
					<a href="admin.php?page=wabaapi_wa_alerts_subscribers" class="button"><?php esc_html_e('Back', 'wabaapi_wa_alerts'); ?></a>
					<input type="submit" class="button-primary" name="wp_update_subscribe" value="<?php esc_html_e('Update', 'wabaapi_wa_alerts'); ?>"/>
				</td>
			</tr>
		</table>
	</form>
</div>