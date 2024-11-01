<?php

	if (!defined('ABSPATH'))
		exit;

	require_once (WABAAPI_WOOCOM_ALERTS_DIR . '/core/wabaapi.class.php');

	global $wpdb, $woocommerce, $product;
	//check wooecommerce plugin
	if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

		// Check if the function hasn't been defined already to prevent function redeclaration errors.
		if (!function_exists('wabaapi_alerts_post_comment')) {
			/**
			 * Hooks a custom function to the 'woocommerce_order_status_changed' action in WooCommerce.
			 *
			 * This action is triggered whenever an order's status changes in WooCommerce. The custom function
			 * 'wabaapi_alerts_order_status' is used to send notifications based on the new order status.
			 */
			add_action("woocommerce_order_status_changed", "wabaapi_alerts_order_status");

			/**
			 * Sends WhatsApp alert based on the order status change in WooCommerce.
			 *
			 * @global WC_Order $order The WooCommerce order object.
			 * @param int $order_id The ID of the order whose status has changed.
			 *
			 * This function checks the new status of the order and sends an appropriate WhatsApp notification to the customer. 
			 * The notification varies depending on whether the order is completed, processing, pending, on-hold, cancelled, refunded, 
			 * or failed. It includes the use of dynamic text replacement to personalize the message for each order and customer.
			 *
			 * Process:
			 * - Create a new instance of the WC_Order class to handle the order data.
			 * - Retrieve the configured options for message templates and settings.
			 * - Determine the order's new status and prepare the corresponding message and template.
			 * - Send the WhatsApp using the 'sendWabaApiWhatsAppPost' method of the 'wabaapi' class if notifications are enabled for the respective status.
			 *
			 * Note:
			 * - The function supports multiple order statuses and can be extended or modified to fit specific needs.
			 * - It is part of a system integrated with WooCommerce, ensuring seamless e-commerce functionalities.
			 */
			function wabaapi_alerts_order_status($order_id) {
				global $woocommerce;
				$order = new WC_Order($order_id);
				$options = get_option('wabaapi_wa_alerts_option_name');
				$isAdminNotifyEnabled = $options['wabaapi_notify_admin'];
				$wabaapi = new wabaapi($options['wabaapi_userId'], $options['wabaapi_password'], FALSE);

				//error_log(print_r($order, true));
				//default phones
				$woocom_shop_phone = $order->get_billing_phone();
				if ($isAdminNotifyEnabled == 'on') {
					$customerPhones = array();
					$customerPhones[] = $options['wabaapi_wp_admin_mobile'];
					array_push($customerPhones, $woocom_shop_phone);
				} else {
					$customerPhones = $woocom_shop_phone;
				}
				$mediaType = '';
				$mediaUrl = '';
				$header = '';
				$footer = '';
				$btnPayload = '';
				//completed
				if ($order->get_status() === 'completed' && $options['wabaapi_alerts_order_completed_status'] == 'on') {
					$msgType = $options['wabaapi_alerts_order_complete_message_type'];
					if ($options['wabaapi_alerts_order_complete_mediaUrl'] != '') {
						$mediaType = $options['wabaapi_alerts_order_complete_media_type'];
						$mediaUrl = $options['wabaapi_alerts_order_complete_mediaUrl'];
					}
					$templateName = $options['wabaapi_alerts_order_complete_tempName'];
					if ($options['wabaapi_alerts_order_complete_header'] != '') {
						$header = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_complete_header'], $order);
					}
					$textMsg = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_complete_tempMsg'], $order);
					if ($options['wabaapi_alerts_order_complete_footer'] != '') {
						$footer = $options['wabaapi_alerts_order_complete_footer'];
					}
					if ($options['wabaapi_alerts_order_complete_btnPayload'] != '') {
						$btnPayload = $options['wabaapi_alerts_order_complete_btnPayload'];
					}
					$result = $wabaapi->sendWabaApiWhatsAppPost($msgType, $templateName, $textMsg, $customerPhones, $mediaType, $mediaUrl, $header, $footer, $btnPayload);
				}
				//processing
				if ($order->get_status() === 'processing' && $options['wabaapi_alerts_order_status_processing'] == 'on') {
					$msgType = $options['wabaapi_alerts_order_processing_message_type'];
					if ($options['wabaapi_alerts_order_processing_mediaUrl'] != '') {
						$mediaType = $options['wabaapi_alerts_order_processing_media_type'];
						$mediaUrl = $options['wabaapi_alerts_order_processing_mediaUrl'];
					}
					$templateName = $options['wabaapi_alerts_order_processing_tempName'];
					if ($options['wabaapi_alerts_order_processing_header'] != '') {
						$header = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_processing_header'], $order);
					}
					$textMsg = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_processing_tempMsg'], $order);
					if ($options['wabaapi_alerts_order_processing_footer'] != '') {
						$footer = $options['wabaapi_alerts_order_processing_footer'];
					}
					if ($options['wabaapi_alerts_order_processing_btnPayload'] != '') {
						$btnPayload = $options['wabaapi_alerts_order_processing_btnPayload'];
					}
					$result = $wabaapi->sendWabaApiWhatsAppPost($msgType, $templateName, $textMsg, $customerPhones, $mediaType, $mediaUrl, $header, $footer, $btnPayload);
				}
				//pending
				if ($order->get_status() === 'pending' && $options['wabaapi_alerts_order_status_pending_payment'] == 'on') {
					$msgType = $options['wabaapi_alerts_order_pending_payment_message_type'];
					if ($options['wabaapi_alerts_order_pending_payment_mediaUrl'] != '') {
						$mediaType = $options['wabaapi_alerts_order_pending_payment_media_type'];
						$mediaUrl = $options['wabaapi_alerts_order_pending_payment_mediaUrl'];
					}
					$templateName = $options['wabaapi_alerts_order_pending_payment_tempName'];
					if ($options['wabaapi_alerts_order_pending_payment_header'] != '') {
						$header = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_pending_payment_header'], $order);
					}
					$textMsg = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_pending_payment_tempMsg'], $order);
					if ($options['wabaapi_alerts_order_pending_payment_footer'] != '') {
						$footer = $options['wabaapi_alerts_order_pending_payment_footer'];
					}
					if ($options['wabaapi_alerts_order_pending_payment_btnPayload'] != '') {
						$btnPayload = $options['wabaapi_alerts_order_pending_payment_btnPayload'];
					}
					$result = $wabaapi->sendWabaApiWhatsAppPost($msgType, $templateName, $textMsg, $customerPhones, $mediaType, $mediaUrl, $header, $footer, $btnPayload);
				}
				//on-hold
				if ($order->get_status() === 'on-hold' && $options['wabaapi_alerts_order_status_onhold'] == 'on') {
					$msgType = $options['wabaapi_alerts_order_onhold_message_type'];
					if ($options['wabaapi_alerts_order_onhold_mediaUrl'] != '') {
						$mediaType = $options['wabaapi_alerts_order_onhold_media_type'];
						$mediaUrl = $options['wabaapi_alerts_order_onhold_mediaUrl'];
					}
					$templateName = $options['wabaapi_alerts_order_onhold_tempName'];
					if ($options['wabaapi_alerts_order_onhold_header'] != '') {
						$header = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_onhold_header'], $order);
					}
					$textMsg = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_onhold_tempMsg'], $order);
					if ($options['wabaapi_alerts_order_onhold_footer'] != '') {
						$footer = $options['wabaapi_alerts_order_onhold_footer'];
					}
					if ($options['wabaapi_alerts_order_onhold_btnPayload'] != '') {
						$btnPayload = $options['wabaapi_alerts_order_onhold_btnPayload'];
					}
					$result = $wabaapi->sendWabaApiWhatsAppPost($msgType, $templateName, $textMsg, $customerPhones, $mediaType, $mediaUrl, $header, $footer, $btnPayload);
				}
				//cancelled
				if ($order->get_status() === 'cancelled' && $options['wabaapi_alerts_order_status_cancelled'] == 'on') {
					$msgType = $options['wabaapi_alerts_order_cancelled_message_type'];
					if ($options['wabaapi_alerts_order_cancelled_mediaUrl'] != '') {
						$mediaType = $options['wabaapi_alerts_order_cancelled_media_type'];
						$mediaUrl = $options['wabaapi_alerts_order_cancelled_mediaUrl'];
					}
					$templateName = $options['wabaapi_alerts_order_cancelled_tempName'];
					if ($options['wabaapi_alerts_order_cancelled_header'] != '') {
						$header = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_cancelled_header'], $order);
					}
					$textMsg = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_cancelled_tempMsg'], $order);
					if ($options['wabaapi_alerts_order_cancelled_footer'] != '') {
						$footer = $options['wabaapi_alerts_order_cancelled_footer'];
					}
					if ($options['wabaapi_alerts_order_cancelled_btnPayload'] != '') {
						$btnPayload = $options['wabaapi_alerts_order_cancelled_btnPayload'];
					}
					$result = $wabaapi->sendWabaApiWhatsAppPost($msgType, $templateName, $textMsg, $customerPhones, $mediaType, $mediaUrl, $header, $footer, $btnPayload);
				}
				//refunded
				if ($order->get_status() === 'refunded' && $options['wabaapi_alerts_order_status_refunded'] == 'on') {
					$msgType = $options['wabaapi_alerts_order_refunded_message_type'];
					if ($options['wabaapi_alerts_order_refunded_mediaUrl'] != '') {
						$mediaType = $options['wabaapi_alerts_order_refunded_media_type'];
						$mediaUrl = $options['wabaapi_alerts_order_refunded_mediaUrl'];
					}
					$templateName = $options['wabaapi_alerts_order_refunded_tempName'];
					if ($options['wabaapi_alerts_order_refunded_header'] != '') {
						$header = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_refunded_header'], $order);
					}
					$textMsg = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_refunded_tempMsg'], $order);
					if ($options['wabaapi_alerts_order_refunded_footer'] != '') {
						$footer = $options['wabaapi_alerts_order_refunded_footer'];
					}
					if ($options['wabaapi_alerts_order_refunded_btnPayload'] != '') {
						$btnPayload = $options['wabaapi_alerts_order_refunded_btnPayload'];
					}
					$result = $wabaapi->sendWabaApiWhatsAppPost($msgType, $templateName, $textMsg, $customerPhones, $mediaType, $mediaUrl, $header, $footer, $btnPayload);
				}
				//failed
				if ($order->get_status() === 'failed' && $options['wabaapi_alerts_order_status_failed'] == 'on') {
					$msgType = $options['wabaapi_alerts_order_failed_message_type'];
					if ($options['wabaapi_alerts_order_failed_mediaUrl'] != '') {
						$mediaType = $options['wabaapi_alerts_order_failed_media_type'];
						$mediaUrl = $options['wabaapi_alerts_order_failed_mediaUrl'];
					}
					$templateName = $options['wabaapi_alerts_order_failed_tempName'];
					if ($options['wabaapi_alerts_order_failed_header'] != '') {
						$header = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_failed_header'], $order);
					}
					$textMsg = wabaapi_wa_alerts_shortcode_variable($options['wabaapi_alerts_order_failed_tempMsg'], $order);
					if ($options['wabaapi_alerts_order_failed_footer'] != '') {
						$footer = $options['wabaapi_alerts_order_failed_footer'];
					}
					if ($options['wabaapi_alerts_order_failed_btnPayload'] != '') {
						$btnPayload = $options['wabaapi_alerts_order_failed_btnPayload'];
					}
					$result = $wabaapi->sendWabaApiWhatsAppPost($msgType, $templateName, $textMsg, $customerPhones, $mediaType, $mediaUrl, $header, $footer, $btnPayload);
				}
			}

		} // End of function_exists check
		// Check if the function hasn't been defined already to prevent function redeclaration errors.
		if (!function_exists('wabaapi_alerts_post_comment')) {
			/**
			 * Hooks a custom function to the 'comment_post' action in WordPress.
			 *
			 * This action is triggered whenever a new comment is posted, but before it is saved in the database.
			 * The custom function 'wabaapi_alerts_post_comment' is used to send notifications when a new comment is posted.
			 */
			add_action('comment_post', 'wabaapi_alerts_post_comment');

			/**
			 * Sends an WhatsApp alert when a new comment is posted for moderation.
			 *
			 * @global WP_Post $product The product associated with the comment.
			 * @global WP_User $current_user The current user making the comment.
			 * @param int $commentId The ID of the newly posted comment.
			 *
			 * This function constructs and sends an WhatsApp notification to the user who posted the comment. The notification
			 * informs them that their review is awaiting approval. The message includes the product's title and the user's first name,
			 * personalizing the alert.
			 *
			 * Process:
			 * - Retrieve user information and the product details associated with the comment.
			 * - Format a message to inform the user that their review is under moderation.
			 * - Send the WhatsApp using the 'sendWabaApiWhatsAppPost' method of the 'wabaapi' class if notifications are enabled.
			 *
			 * Note:
			 * - The function is part of a WooCommerce-based system, where product reviews are a key interaction.
			 * - It leverages WooCommerce and WordPress functions to extract relevant user and product information.
			 */
			function wabaapi_alerts_post_comment($commentId) {
				global $product, $current_user;
				if (isset($_POST['_wpnonce'])) {
					$nonce = sanitize_text_field($_POST['_wpnonce']);
					if (!wp_verify_nonce($nonce, 'comment_form_' . get_the_ID())) {
						// Nonce verification failed, handle accordingly (e.g., show an error message or exit)
						return;
					}
					$options = get_option('wabaapi_wa_alerts_option_name');
					wp_get_current_user();
					$user_id = get_current_user_id();
					$name = $current_user->user_firstname;
					$customerPhones = get_user_meta($user_id, 'billing_phone', true);
					$post_id = isset($_POST['comment_post_ID']) ? (int) sanitize_text_field($_POST['comment_post_ID']) : 0;
					$product = wc_get_product($post_id);
					$title = $product->get_title(); // Use get_title() method to get the product title
					$textMsg = "Thank You! " . $name . ", \nYour review on " . $title . " is awaiting for approval. Your feedback will help millions of other customers, we really appreciate the time and effort you spent in sharing your personal experience with us.";
					$wabaapi = new wabaapi($options['wabaapi_userId'], $options['wabaapi_password'], false);
					if ($options['wabaapi_product_review_notification'] == 'on') {
						$wabaapi->sendWabaApiWhatsAppPost($textMsg, $customerPhones);
					}
				}
			}

		} // End of function_exists check
		// Check if the function doesn't already exist to avoid function redeclaration errors.
		if (!function_exists('wabaapi_alerts_comment_approved')) {
			/**
			 * Hooks a custom function to the 'transition_comment_status' action in WordPress.
			 *
			 * This action is triggered whenever a comment's status transitions, for example from 'pending' to 'approved'.
			 * The custom function 'wabaapi_alerts_comment_approved' is used to send notifications when a comment is approved.
			 */
			add_action('transition_comment_status', 'wabaapi_alerts_comment_approved', 10, 3);

			/**
			 * Sends WhatsApp alert when a comment is approved.
			 *
			 * @global WP_Post $product The product associated with the comment.
			 * @param string $new_status The new status of the comment.
			 * @param string $old_status The old status of the comment.
			 * @param WP_Comment $comment The comment object.
			 *
			 * This function checks if the comment's status has changed to 'approved'. If so, it retrieves the user's phone number
			 * and sends WhatsApp notification to thank them for their product review. The message includes the product's title and
			 * the customer's name, personalizing the alert.
			 *
			 * Process:
			 * - Verify that the comment's status has transitioned to 'approved'.
			 * - Retrieve user information and product details associated with the comment.
			 * - Format a personalized thank-you message for the approved review.
			 * - Send the WhatsApp using the 'sendWabaApiWhatsAppPost' method of the 'wabaapi' class if notifications are enabled.
			 *
			 * Note:
			 * - The function is part of a WooCommerce-based system, where product reviews are crucial.
			 * - It utilizes WooCommerce and WordPress functions to get user and product data.
			 */
			function wabaapi_alerts_comment_approved($new_status, $old_status, $comment) {
				if ($old_status != $new_status) {
					if ($new_status == 'approved') {
						global $product;
						$options = get_option('wabaapi_wa_alerts_option_name');
						$userid = $comment->user_id;
						$user_data = get_userdata($userid);
						$name = $user_data->display_name;
						$post_id = $comment->comment_post_ID;
						$customerPhones = get_user_meta($userid, 'billing_phone', true);
						$product = wc_get_product($post_id);
						$title = $product->post->post_title;
						$textMsg = "Thank You " . $name . ", \nYour review on " . $title . " has been published. Your feedback will help millions of other customers, we really appreciate the time and effort you spent in sharing your personal experience with us.";
						$wabaapi = new wabaapi($options['wabaapi_userId'], $options['wabaapi_password'], FALSE);
						if ($options['wabaapi_product_review_notification'] == 'on') {
							$wabaapi->sendWabaApiWhatsAppPost($textMsg, $customerPhones);
						}
					}
				}
			}

		} // End of function_exists check
	}