<?php
	if (!defined('ABSPATH'))
		exit;
?>
<div class="postbox">
	<div class="inside">
		<p><?php esc_html_e('Leave fields empty if they\'re not necessary. Ensure the template content matches what has been approved by Meta.', 'wabaapi_wa_alerts'); ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th><?php esc_html_e('Message Type', 'wabaapi_wa_alerts'); ?>:</th>
					<td>
						<div>
							<select name="wabaapi_wa_alerts_option_name[<?php echo esc_attr($template_name); ?>_message_type]" id="<?php echo esc_attr($template_name); ?>_message_type">
								<option value="text"<?php if (isset($options[$template_name . '_message_type']) && trim($options[$template_name . '_message_type']) == '') echo ' selected="selected"'; ?>><?php esc_html_e('Text', 'wabaapi_wa_alerts'); ?>&nbsp;</option>
								<option value="media"<?php if (isset($options[$template_name . '_message_type']) && trim($options[$template_name . '_message_type']) == 'media') echo ' selected="selected"'; ?>><?php esc_html_e('Media', 'wabaapi_wa_alerts'); ?>&nbsp;</option>
							</select>

						</div>
					</td>
				</tr>
				<tr class="<?php echo esc_attr($template_name); ?>_mediaDiv" style="display:none">
					<th><?php esc_html_e('Media Type', 'wabaapi_wa_alerts'); ?>:</th>
					<td>
						<div>
							<select name="wabaapi_wa_alerts_option_name[<?php echo esc_attr($template_name); ?>_media_type]" id="<?php echo esc_attr($template_name); ?>_media_type">
								<option value="">Select</option>
								<option value="image"<?php if (isset($options[$template_name . '_media_type']) && trim($options[$template_name . '_media_type']) == '') echo ' selected="selected"'; ?>><?php esc_html_e('Image', 'wabaapi_wa_alerts'); ?>&nbsp;</option>
								<option value="video"<?php if (isset($options[$template_name . '_media_type']) && trim($options[$template_name . '_media_type']) == 'media') echo ' selected="selected"'; ?>><?php esc_html_e('Video', 'wabaapi_wa_alerts'); ?>&nbsp;</option>
								<option value="document"<?php if (isset($options[$template_name . '_media_type']) && trim($options[$template_name . '_media_type']) == 'media') echo ' selected="selected"'; ?>><?php esc_html_e('Document', 'wabaapi_wa_alerts'); ?>&nbsp;</option>
							</select>

						</div>
					</td>
				</tr>
				<tr class="<?php echo esc_attr($template_name); ?>_mediaDiv" style="display:none">
					<th><?php esc_html_e('Media URL', 'wabaapi_wa_alerts'); ?>:</th>
					<td>
						<input type="text" name="wabaapi_wa_alerts_option_name[<?php echo esc_attr($template_name); ?>_mediaUrl]" id="<?php echo esc_attr($template_name); ?>_mediaUrl" size="45" value="<?php if (isset($options[$template_name . '_mediaUrl'])) echo trim(esc_attr($options[$template_name . '_mediaUrl'])); ?>" />
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e('Template Name', 'wabaapi_wa_alerts'); ?>:</th>
					<td>
						<input type="text" name="wabaapi_wa_alerts_option_name[<?php echo esc_attr($template_name); ?>_tempName]" id="<?php echo esc_attr($template_name); ?>_tempName" size="45" value="<?php if (isset($options[$template_name . '_tempName'])) echo trim(esc_attr($options[$template_name . '_tempName'])); ?>" />
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e('Header (Optional)', 'wabaapi_wa_alerts'); ?>:</th>
					<td>
						<input type="text" name="wabaapi_wa_alerts_option_name[<?php echo esc_attr($template_name); ?>_header]" id="<?php echo esc_attr($template_name); ?>_header" size="45" value="<?php if (isset($options[$template_name . '_header'])) echo trim(esc_attr($options[$template_name . '_header'])); ?>" />
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e('Template Content', 'wabaapi_wa_alerts'); ?>:</th>
					<td>
						<div >
							<textarea name="wabaapi_wa_alerts_option_name[<?php echo esc_attr($template_name); ?>_tempMsg]" id="<?php echo esc_attr($template_name); ?>_tempMsg" rows="3" cols="50"><?php if (isset($options[$template_name . '_tempMsg'])) echo trim(esc_attr($options[$template_name . '_tempMsg'])); ?></textarea>
						</div>
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e('Footer (Optional)', 'wabaapi_wa_alerts'); ?>:</th>
					<td>
						<input type="text" name="wabaapi_wa_alerts_option_name[<?php echo esc_attr($template_name); ?>_footer]" id="<?php echo esc_attr($template_name); ?>_footer" size="45" value="<?php if (isset($options[$template_name . '_footer'])) echo trim(esc_attr($options[$template_name . '_footer'])); ?>" />
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e('Buttons Payload (JSON)', 'wabaapi_wa_alerts'); ?>:</th>
					<td>
						<div>
							<textarea placeholder="<?php echo esc_attr('{ "button1": "Hello_button1", "button2": "Hello_button2", "button3": "Hello_button3" }'); ?>" name="wabaapi_wa_alerts_option_name[<?php echo esc_attr($template_name); ?>_btnPayload]" id="<?php echo esc_attr($template_name); ?>_btnPayload" rows="3" cols="50"><?php if (isset($options[$template_name . '_btnPayload'])) echo trim(esc_attr($options[$template_name . '_btnPayload'])); ?></textarea>
						</div>
						<br/>
						- <?php esc_html_e('You have to use JSON payload for buttons.', 'wabaapi_wa_alerts'); ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>