<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
<section class="woocommerce-order-details">
	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

	<h2 class="woocommerce-order-details__title text-16 text-uppercase"><?php esc_html_e( 'Chi tiết đơn hàng', 'woocommerce' ); ?></h2>
	<div class="block-c p-3 p-lg-4 mb-4">
		<div class="woocommerce-table woocommerce-table--order-details shop_table order_details">
	
			<!-- <thead>
				<tr>
					<th class="woocommerce-table__product-name product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
					<th class="woocommerce-table__product-table product-total"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
				</tr>
			</thead> -->
	
			<div class="bg-white p-3 rounded mb-4">
				<?php
				do_action( 'woocommerce_order_details_before_order_table_items', $order );
	
				foreach ( $order_items as $item_id => $item ) {
					$product = $item->get_product();
					// wc_get_template(
					// 	'order/order-details-item.php',
					// 	array(
					// 		'order'              => $order,
					// 		'item_id'            => $item_id,
					// 		'item'               => $item,
					// 		'show_purchase_note' => $show_purchase_note,
					// 		'purchase_note'      => $product ? $product->get_purchase_note() : '',
					// 		'product'            => $product,
					// 	)
					// );
					if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
						return;
					}
					?>
					<div class="media my-3 <?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">
						<div class="img-donhang"><?php echo $product->get_image(); ?></div>
						<div class="media-body pl-3">
							<div class="woocommerce-table__product-name product-name">								
									<?php
									$is_visible        = $product && $product->is_visible();
									$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
							
									echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a class="text-16 text-uppercase font-weight-bold d-block mb-2" href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ) );
							
									$qty          = $item->get_quantity();
									$refunded_qty = $order->get_qty_refunded_for_item( $item_id );
							
									if ( $refunded_qty ) {
										$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
									} else {
										$qty_display = esc_html( $qty );
									}
										echo '<div class="mb-2">Số lượng:';
											echo apply_filters( 'woocommerce_order_item_quantity_html', ' <span class="product-quantity">' . sprintf( '&nbsp;%s', $qty_display ) . '</span>', $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										echo '</div>';
										echo '<div>Giá: '. WC()->cart->get_product_price($product) .'</div>';
									do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );
							
									wc_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							
									do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
									?>
								
							</div>
						</div>
					
						<!-- <div class="woocommerce-table__product-total product-total">
							<?php echo $order->get_formatted_line_subtotal( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div> -->
					
					</div>
					
					
					<?php if ( $show_purchase_note && $purchase_note ) : ?>
					
					<div class="woocommerce-table__product-purchase-note product-purchase-note">
					
						<div colspan="2"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					
					</div>
					
					<?php endif; 
				}
	
				do_action( 'woocommerce_order_details_after_order_table_items', $order );
				?>
			</div>
	
			<div>
				
				<?php
					if ( $order ) {					
						echo '<div class="d-flex justify-content-between align-items-center"><div class="text-uppercase font-weight-bold">Tổng tiền:</div><div class="font-weight-bold red text-30">';
							echo $order->get_formatted_order_total();
						echo '</div></div>';
					}

				//foreach ( $order->get_order_item_totals() as $key => $total ) {	
					?>
					<!-- <div class="d-flex justify-content-between">
						<div scope="row"><?php echo esc_html( $total['label'] ); ?></div>
						<div><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					</div> -->
					<?php
				//}
				?>
				<?php if ( $order->get_customer_note() ) : ?>
					<div>
						<div class="my-2"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></div>
						<div class="my-2"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></div>
					</div>
				<?php endif; ?>
			</div>
		</div>

	</div>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</section>

<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
