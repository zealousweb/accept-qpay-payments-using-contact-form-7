<?php
/**
* Displays content for plugin option page
*
* @package WordPress
* @subpackage Accept Qpay payments Using Contact form 7
* @since 1.1
* @version 1.1
*/

$post_id = ( isset( $_REQUEST[ 'post' ] ) ? sanitize_text_field( $_REQUEST[ 'post' ] ) : '' );

if ( empty( $post_id ) ) {
	$wpcf7 = WPCF7_ContactForm::get_current();
	$post_id = $wpcf7->id();
}

wp_enqueue_script( 'wp-pointer' );
wp_enqueue_style( 'wp-pointer' );

wp_enqueue_style( 'select2' );
wp_enqueue_script( 'select2' );

wp_enqueue_style( CFQPZW_PREFIX . '_admin_css' );

$use_qpay				= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'use_qpay', true );
$payment_mode			= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'payment_mode', true );
$qpay_gateway_id		= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'qpay_gateway_id', true );
$qpay_secret_key		= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'qpay_secret_key', true );
$order_unique_prefix	= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'order_unique_prefix', true );
$amount					= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'amount', true );
$customer_name			= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'customer_name', true );
$customer_address		= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'customer_address', true );
$customer_city			= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'customer_city', true );
$customer_state			= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'customer_state', true );
$customer_country		= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'customer_country', true );
$customer_phone			= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'customer_phone', true );
$customer_email			= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'customer_email', true );
$quantity				= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'quantity', true );
$success_return_url		= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'returnurl', true );
$currency				= get_post_meta( $post_id, CFQPZW_META_PREFIX . 'currency', true );
$cfqpzw_review 			= get_option( 'cfqpzw_review' );
$currency_code = array(
	'QAR' => 'Qatari Riyal'
);
$currency_code = apply_filters( CFQPZW_META_PREFIX .'add_currency', $currency_code );

$payment_modes = array(
	'sandbox'	=> __( 'Sandbox', 'accept-qpay-payments-using-contact-form-7'),
	'live'		=> __( 'Live', 'accept-qpay-payments-using-contact-form-7')
);

$args = array(
	'post_type'			=> array( 'page' ),
	'orderby'			=> 'title',
	'posts_per_page'	=> -1
);

$pages = get_posts( $args );
$all_pages = array();

if ( !empty( $pages ) ) {
	foreach ( $pages as $page ) {
		$all_pages[$page->ID] = $page->post_title;
	}
}

if ( !empty( $post_id ) ) {
	$cf7 = WPCF7_ContactForm::get_instance($_REQUEST['post']);
	$tags = $cf7->collect_mail_tags();
}

echo '<div class="cfqpzw-settings">' .
	'<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="inner-modal">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">'. __('Support us!', 'accept-qpay-payments-using-contact-form-7').'</h4>
					</div>
					<div class="modal-body">
						<p>' . __('If you like this plugin please spare some time to review us.', 'accept-qpay-payments-using-contact-form-7').'</p>
					</div>
					<div class="modal-footer">
						<a href="https://wordpress.org/support/plugin/accept-qpay-payments-using-contact-form-7/reviews/" class="button primary-button review-cfqpzw" target="_blank">' . __('Review us', 'accept-qpay-payments-using-contact-form-7'). '</a>
						<button type="button" class="btn btn-default remind-cfqpzw" data-dismiss="modal">'. __('Remind Me Later', 'accept-qpay-payments-using-contact-form-7').'</button>
					</div>
					<div class="bird-icon">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="71.366" height="49.822" viewBox="0 0 71.366 49.822"><defs><linearGradient id="a" x1="0.121" y1="0.5" x2="1.122" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#3daeb5"/><stop offset="0.23" stop-color="#56c5d0"/><stop offset="0.505" stop-color="#56c5d0"/><stop offset="0.887" stop-color="#0074a2"/></linearGradient><linearGradient id="b" x1="0.142" y1="-0.312" x2="1.28" y2="1.261" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#56c5d0"/><stop offset="0.5" stop-color="#0074a2"/><stop offset="1" stop-color="#22566e"/></linearGradient><linearGradient id="c" x1="0.001" y1="0.5" x2="0.996" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#c81f66"/><stop offset="0.446" stop-color="#f05b89"/><stop offset="1" stop-color="#c81f66"/></linearGradient><linearGradient id="d" x1="0.023" y1="0.477" x2="0.997" y2="0.477" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#ffc93e"/><stop offset="1" stop-color="#f69047"/></linearGradient><linearGradient id="e" x1="-0.009" y1="0.5" x2="1.091" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#ed1651"/><stop offset="1" stop-color="#f05b7d"/></linearGradient><linearGradient id="f" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#22566e"/><stop offset="0.992" stop-color="#3daeb5"/></linearGradient><linearGradient id="g" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#0074a2"/><stop offset="1" stop-color="#56c5d0"/></linearGradient></defs><g transform="translate(-6211.895 1682)"><path d="M657.551,270.4H653.7v.708a2.425,2.425,0,0,0,2.417,2.418h3.851v-.708A2.424,2.424,0,0,0,657.551,270.4Z" transform="translate(5609.742 -1905.704)" fill="#0074a2"/><path d="M615.251,270.4H611.4v.708a2.424,2.424,0,0,0,2.418,2.418h3.851v-.708a2.424,2.424,0,0,0-2.418-2.418Z" transform="translate(5644.736 -1905.704)" fill="#f05b89"/><path d="M572.951,270.4H569.1v.708a2.424,2.424,0,0,0,2.418,2.418h3.851v-.708A2.425,2.425,0,0,0,572.951,270.4Z" transform="translate(5679.73 -1905.704)" fill="#f79548"/><g transform="translate(6211.895 -1682)"><path d="M396.147,61.5c-5.544-1.9-8.065-4.127-11.1-6.735s-4.093-4.491-5.838-6.649c-1.76-2.158-3.727-6.269-6.77-9.309s-8.635-3.416-12.676-1.261a9.288,9.288,0,0,0-4.555,6.6c5.406-.828,7.634,3.368,9.239,6.649s1.83,6.839,2.158,9.171c1.122,7.91,6.217,12.521,12.123,13.919,2.021.553,7.53,2.07,9,2.642,0,0-3.178-1.623-4.006-2.21H383.7c.553-.034,1.623-.138,2.174-.225a14.6,14.6,0,0,1,3.61,1.174s-2.124-1.537-2.158-1.537a17.242,17.242,0,0,0,7.081-3.886c.1-.1.207-.19.311-.294a19.955,19.955,0,0,1,4.577-3.16,29.966,29.966,0,0,1,11.122-3.039C403.5,63.039,398.254,62.228,396.147,61.5Z" transform="translate(-355.204 -29.935)" fill="url(#a)"/><g transform="translate(39.216 33.296)"><path d="M582.3,199.425a12.265,12.265,0,0,1,8.1-1.486c4.006.656,8.342,4.438,14.04,5.561.294.069.587.138.881.19,4.244.708,9.394-1.088,9.118-4.093C613.667,191.152,591.885,190.029,582.3,199.425Z" transform="translate(-582.3 -192.812)" fill="url(#b)"/></g><path d="M390.757,59.183a.558.558,0,0,1-.587.57.579.579,0,1,1,.587-.57Z" transform="translate(-383.663 -48.478)" fill="#fff"/><path d="M483.85,49.384c-4.179.587-8,1.261-11.485,1.987-37.735,7.944-36.2,24.126-31.38,29.135,13.332,13.9,40.188-25.8,43.227-30.706C484.351,49.591,484.127,49.35,483.85,49.384Z" transform="translate(-424.118 -40.855)" fill="url(#c)"/><path d="M471.249.044c-3.9,1.71-7.409,3.385-10.587,5.026-34.384,17.788-28.5,33.055-21.76,36.146,18.841,8.635,31.345-35.4,32.83-40.878C471.8.1,471.508-.06,471.249.044Z" transform="translate(-420.186 -0.011)" fill="url(#d)"/><path d="M433.693,84.508c.138-6.562,6.632-15.491,32.485-17.46.38-.881.794-2.07,1.242-3.209a5.587,5.587,0,0,1,.225-.57c.346-.9.639-1.727.863-2.366C440.636,66.616,433.572,77.548,433.693,84.508Z" transform="translate(-420.14 -50.384)" fill="url(#e)"/><path d="M489.539,94.923c-2.953-.1-6.51-.155-9.136-.138-7.478,9.36-20.793,25.9-31.414,26.319a9.764,9.764,0,0,1-1.606-.121h-.069a10.178,10.178,0,0,1-5.492-2.8c-1.382-1.313-2.021-2.522-1.191-1.33,11.226,15.854,45.161-17.391,49.185-21.467C490.006,95.2,489.833,94.939,489.539,94.923Z" transform="translate(-425.575 -78.415)" fill="url(#f)"/><path d="M475.131,94.8c-1.157,0-2.315.018-3.416.052-30.1.76-37.873,10.448-38.012,17.253a8.765,8.765,0,0,0,2.522,6.1,10.111,10.111,0,0,0,5.422,2.8h.069a15.594,15.594,0,0,0,1.589.121C454.355,121.119,468.172,104.367,475.131,94.8Z" transform="translate(-420.147 -78.43)" fill="url(#g)"/><path d="M466.105,96.6c-25.456,1.882-32.364,10.707-32.505,16.994a8.592,8.592,0,0,0,2.588,6.1,11.153,11.153,0,0,0,2.21,1.623,11.852,11.852,0,0,0,3.9,1.226c.38.034.76.052,1.139.069a13.52,13.52,0,0,0,2.608-.276C454.773,120.225,461.768,107.325,466.105,96.6Z" transform="translate(-420.065 -79.919)" fill="url(#g)"/></g></g></svg>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="left-box postbox">' .
		'<table class="form-table">' .
			'<tbody>';

				if( empty( $tags ) ) {

					echo '<tr class="form-field">' .
						'<td>' .
							__( 'To use QPay option, first you need to create and save form tags.', 'accept-qpay-payments-using-contact-form-7' ).
							' <a href="'. CFQPZW_DOCUMENT .'" target="_blank">' . __( 'Document Link', 'accept-qpay-payments-using-contact-form-7' ) . '</a>'.
						'</td>' .
					'</tr>';

				} else {

					echo '<tr class="form-field">' .
						'<th scope="row">' .
							'<label for="' . CFQPZW_META_PREFIX . 'use_qpay">' .
								__( 'QPay Enable', 'accept-qpay-payments-using-contact-form-7' ) .
							'</label>' .
						'</th>' .
						'<td>' .
							'<input id="' . CFQPZW_META_PREFIX . 'use_qpay" name="' . CFQPZW_META_PREFIX . 'use_qpay" type="checkbox" class="enable_required" value="1" ' . checked( $use_qpay, 1, false ) . '/>' .
						'</td>' .
					'</tr>' .
					'<tr class="form-field">' .
						'<th scope="row">' .
							'<label for="' . CFQPZW_META_PREFIX . 'payment_mode">' .
								__( 'Payment Mode ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
						'</th>' .
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'payment_mode" class="'.CFQPZW_META_PREFIX. 'required-fields" name="' . CFQPZW_META_PREFIX . 'payment_mode" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . '>';
								if ( !empty( $payment_modes ) ) {
									foreach ( $payment_modes as $key => $value ) {
										echo '<option value="' . esc_attr( $key ) . '" ' . selected( $payment_mode, $key, false ) . '>' . esc_attr( $value ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>' .
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'qpay_gateway_id">' .
								__( 'QPay Gateway ID ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-gatewayid"></span>' .
						'</th>' .
						'<td>' .
							'<input id="' . CFQPZW_META_PREFIX . 'qpay_gateway_id" name="' . CFQPZW_META_PREFIX . 'qpay_gateway_id" type="text" class="large-text" value="' . esc_attr( $qpay_gateway_id ) . '" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . ' />' .
						'</td>' .
					'</tr>' .
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'qpay_secret_key">' .
								__( 'QPay Secret Key ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-secretkey"></span>' .
						'</th>' .
						'<td>' .
							'<input id="' . CFQPZW_META_PREFIX . 'qpay_secret_key" name="' . CFQPZW_META_PREFIX . 'qpay_secret_key" type="text" class="large-text" value="' . esc_attr( $qpay_secret_key ) . '" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . ' />' .
						'</td>' .
					'</tr>' .

					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'amount">' .
								__( 'Amount Field Name ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-amount"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'amount" class="cfqpzw-required-fields" name="' . CFQPZW_META_PREFIX . 'amount">' .
								'<option value="">' . __( 'Select field name for amount', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<option value="' . esc_attr( $tag ) . '" ' . selected( $amount, $tag, false )  . '>' . esc_html( $tag ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>'.

					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'quantity">' .
								__( 'Quantity Field Name (Optional)', 'accept-qpay-payments-using-contact-form-7' ) .
							'</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-quantity"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'quantity" name="' . CFQPZW_META_PREFIX . 'quantity">' .
								'<option>' . __( 'Select field name for quantity', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<option value="' . esc_attr( $tag ) . '" ' . selected( $quantity, $tag, false )  . '>' . esc_html( $tag ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>'.
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'currency">' .
								__( 'Select Currency', 'accept-qpay-payments-using-contact-form-7' ) .
							'</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-select-currency"></span>' .
						'</th>' .
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'currency" name="' . CFQPZW_META_PREFIX . 'currency">';

								if ( !empty( $currency_code ) ) {
									foreach ( $currency_code as $code => $currencies ) {
										echo '<option value="' . esc_attr( $code ) . '" ' . selected( $currency, $code, false ) . '>' . esc_attr( $currencies ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr/>' .
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'order_unique_prefix">' .
								__( 'Order Unique Prefix (Optional)', 'accept-qpay-payments-using-contact-form-7' ) .
							'</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-prefix"></span>' .
						'</th>' .
						'<td>' .
							'<input id="' . CFQPZW_META_PREFIX . 'order_unique_prefix" name="' . CFQPZW_META_PREFIX . 'order_unique_prefix" type="text" class="large-text" value="' . esc_attr( $order_unique_prefix ) . '" autocomplete="off" />' .
						'</td>' .
					'</tr>' .
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'returnurl">' .
								__( 'Success Return URL (Optional)', 'accept-qpay-payments-using-contact-form-7' ) .
							'</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-success-returnurl"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'returnurl" name="' . CFQPZW_META_PREFIX . 'returnurl">' .
								'<option>' . __( 'Select page', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $all_pages ) ) {
									foreach ( $all_pages as $post_Id => $title ) {
										echo '<option value="' . esc_attr( $post_Id ) . '" ' . selected( $success_return_url, $post_Id, false )  . '>' . $title . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>';

					// Shipping Fields
					echo '<tr class="form-field">' .
						'<th colspan="2">' .
							'<label for="' . CFQPZW_META_PREFIX . 'customer_shipping_details">' .
								'<h3 style="margin: 0;">' .
									__( 'Customer Billing Details', 'accept-qpay-payments-using-contact-form-7' ) .
									'<span class="arrow-switch"></span>' .
								'</h3>' .
							'</label>' .
						'</th>' .
					'</tr>'.
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'customer_name">' .
								__( 'Customer Name ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-customer-name"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'customer_name" class="cfqpzw-required-fields" name="' . CFQPZW_META_PREFIX . 'customer_name" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . '>' .
								'<option value="">' . __( 'Select field name for customer name', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<option value="' . esc_attr( $tag ) . '" ' . selected( $customer_name, $tag, false )  . '>' . esc_html( $tag ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>'.
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'customer_address">' .
								__( 'Customer Address ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-customer-address"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'customer_address" class="cfqpzw-required-fields" name="' . CFQPZW_META_PREFIX . 'customer_address" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . '>' .
								'<option value="">' . __( 'Select field name for customer address', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<option value="' . esc_attr( $tag ) . '" ' . selected( $customer_address, $tag, false )  . '>' . esc_html( $tag ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>'.
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'customer_city">' .
								__( 'Customer City ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-customer-city"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'customer_city" class="cfqpzw-required-fields" name="' . CFQPZW_META_PREFIX . 'customer_city" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . '>' .
								'<option value="">' . __( 'Select field name for customer city', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<option value="' . esc_attr( $tag ) . '" ' . selected( $customer_city, $tag, false )  . '>' . esc_html( $tag ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>'.
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'customer_state">' .
								__( 'Customer State ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-customer-state"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'customer_state" class="cfqpzw-required-fields" name="' . CFQPZW_META_PREFIX . 'customer_state" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . '>' .
								'<option value="">' . __( 'Select field name for customer state', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<option value="' . esc_attr( $tag ) . '" ' . selected( $customer_state, $tag, false )  . '>' . esc_html( $tag ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>'.
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'customer_country">' .
								__( 'Customer Country ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-customer-country"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'customer_country" class="cfqpzw-required-fields" name="' . CFQPZW_META_PREFIX . 'customer_country" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . '>' .
								'<option value="">' . __( 'Select field name for customer country', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<option value="' . esc_attr( $tag ) . '" ' . selected( $customer_country, $tag, false )  . '>' . esc_html( $tag ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>'.
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'customer_phone">' .
								__( 'Customer Phone ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-customer-phone"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'customer_phone" class="cfqpzw-required-fields" name="' . CFQPZW_META_PREFIX . 'customer_phone" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . '>' .
								'<option value="">' . __( 'Select field name for customer phone', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<option value="' . esc_attr( $tag ) . '" ' . selected( $customer_phone, $tag, false )  . '>' . esc_html( $tag ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>'.
					'<tr class="form-field">' .
						'<th>' .
							'<label for="' . CFQPZW_META_PREFIX . 'customer_email">' .
								__( 'Customer Email ', 'accept-qpay-payments-using-contact-form-7' ) .
							'*</label>' .
							'<span class="cfqpzw-tooltip hide-if-no-js" id="cfqpzw-customer-email"></span>' .
						'</th>'.
						'<td>' .
							'<select id="' . CFQPZW_META_PREFIX . 'customer_email" class="cfqpzw-required-fields" name="' . CFQPZW_META_PREFIX . 'customer_email" ' . ( !empty( $use_qpay ) ? 'required' : '' ) . '>' .
								'<option value="">' . __( 'Select field name for customer email', 'accept-qpay-payments-using-contact-form-7' ) . '</option>';
								if( !empty( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<option value="' . esc_attr( $tag ) . '" ' . selected( $customer_email, $tag, false )  . '>' . esc_html( $tag ) . '</option>';
									}
								}

							echo '</select>' .
						'</td>' .
					'</tr>';

					/**
					 * - Add new field at the end.
					 *
					 * @var int $post_id
					 */
					do_action( CFQPZW_META_PREFIX . 'add_fields', $post_id );

					echo '<input type="hidden" name="post" value="' . $post_id . '">';
				}
			echo '</tbody>'.
		'</table>' .
	'</div>' .
	'<div class="right-box">';
		/**
		 * Add new post box to display the information.
		 */
		do_action( CFQPZW_PREFIX . '/postbox' );

	echo '</div>' .
'</div>';

$translation_array = array(
	'gatewayid'         => __('<h3>QPay Gateway ID</h3>' .
								'<p>You can get your QPay Gateway ID from <a href="https://qpayi.com/login" target="_blank">here</a>. </p>',
								'accept-qpay-payments-using-contact-form-7'),
	'secret_key'        => __('<h3>QPay Secret Key</h3>' .
								'<p>You can get your QPay Secret Key from <a href="https://qpayi.com/login" target="_blank">here</a>. </p>',
								'accept-qpay-payments-using-contact-form-7'),
	'amount'            => __( '<h3>Amount Field </h3>' .
								'<p>Select field from where amount value needs to be retrieved. </p>'.
								'<p><b>Note: </b> Save the FORM details to view the list of fields.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'quantity'          => __( '<h3>Quantity Field </h3>' .
								'<p>Select field from where quantity value needs to be retrieved. </p>'.
								'<p><b>Note: </b> Save the FORM details to view the list of fields.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'currency'          => __( '<h3>Select Currency</h3>' .
								'<p>Select the currency.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'orderid_prefix'    => __( '<h3>Order Prefix</h3>' .
								'<p>Please enter unique prefix name which display in invoice order ( Special Characters are not allowed ). </p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'success_url'       => __( '<h3>Success Return URL</h3>' .
								'<p>Select page and redirect customer after successfully payment done. </p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'customer_name'     => __( '<h3>Customer Name Field </h3>' .
								'<p>Select field from where customer billing name value needs to be retrieved. </p>'.
								'<p><b>Note: </b> Save the FORM details to view the list of fields.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'customer_address'  => __( '<h3>Customer Address Field </h3>' .
								'<p>Select field from where customer billing address value needs to be retrieved. </p>'.
								'<p><b>Note: </b> Save the FORM details to view the list of fields.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'customer_city'     => __( '<h3>Customer City Field </h3>' .
								'<p>Select field from where customer billing city value needs to be retrieved. </p>'.
								'<p><b>Note: </b> Save the FORM details to view the list of fields.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'customer_state'    => __( '<h3>Customer State Field </h3>' .
								'<p>Select field from where customer billing state value needs to be retrieved. </p>'.
								'<p><b>Note: </b> Save the FORM details to view the list of fields.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'customer_country'  => __( '<h3>Customer Country Field </h3>' .
								'<p>Select field from where customer billing country value needs to be retrieved. </p>'.
								'<p><b>Note: </b> Save the FORM details to view the list of fields.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'customer_phone'    => __( '<h3>Customer Phone No. Field </h3>' .
								'<p>Select field from where customer billing phone no. value needs to be retrieved. </p>'.
								'<p><b>Note: </b> Save the FORM details to view the list of fields.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'customer_email'    => __( '<h3>Customer Email Field </h3>' .
								'<p>Select field from where customer billing email value needs to be retrieved. </p>'.
								'<p><b>Note: </b> Save the FORM details to view the list of fields.</p>',
								'accept-qpay-payments-using-contact-form-7' ),
	'cfqpzw_review'		=> $cfqpzw_review

);
wp_enqueue_script( CFQPZW_PREFIX . '_modal_js' );
wp_enqueue_script( CFQPZW_PREFIX . '_cookie_js' );
wp_localize_script( CFQPZW_PREFIX . '_admin_js', 'cfqpzw_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'translate_string_cfqpzw' => $translation_array ) );
wp_enqueue_script( CFQPZW_PREFIX . '_admin_js' );
