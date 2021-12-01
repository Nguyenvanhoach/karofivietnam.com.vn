<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
			<div class="d-flex my-4 txt_thank justify-content-center align-items-center font-weight-bold">
				<img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/sucess.png" alt="Thanks you" class="img-fluid mr-3" />
				<div class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'CÁM ƠN QUÝ KHÁCH ĐÃ ĐẶT HÀNG', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			</div>
			<div class="row px-lg-5">
				<div class="col-md-6 pr-lg-4 mb-3 mb-md-0">
					<div class="mb-4">
						<p>Xin chào Anh/Chị <strong><?php if ( $order->get_billing_first_name() ) : echo esc_html( $order->get_billing_first_name() ); endif; ?></strong></p>
						<p>Chúng tôi đã nhận được đơn hàng của quý khách trên website.<br>Đơn hàng này đang được xử lý.</p>
						<p>Trong vòng 30 phút (giờ làm việc), bộ phận bán hàng trực tuyến sẽ liên hệ lại. Qúy khách để xác nhận thời gian và địa điểm giao hàng.</p>
						<p>Thời gian giao hàng dự kiến khoảng 24h - 48h.</p>
						<p style="color: #a90a0d;font-weight: bold;">Cám ơn quý khách !</p>
					</div>
					<h3 class="text-16 text-uppercase">Thông tin khách hàng</h3>
					<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details list-unstyled block-c p-3">
						<li class="woocommerce-order-overview__order order my-2 d-flex justify-content-between">
						<strong><?php esc_html_e( 'Mã đơn hàng:', 'woocommerce' ); ?></strong>
							<span class="text-right"><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						</li>

						<li class="woocommerce-order-overview__date date my-2 d-flex justify-content-between">
							<strong><?php esc_html_e( 'Ngày đặt hàng:', 'woocommerce' ); ?></strong>
							<span class="text-right"><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						</li>

						<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
							<li class="woocommerce-order-overview__email email my-2 d-flex justify-content-between">
								<strong><?php esc_html_e( 'Email:', 'woocommerce' ); ?></strong>
								<span class="text-right"><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							</li>
						<?php endif; ?>

						<li class="woocommerce-order-overview__total total my-2 d-flex justify-content-between">
							<strong><?php esc_html_e( 'Tổng tiền:', 'woocommerce' ); ?></strong>
							<span class="text-right wrap-price"><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						</li>

						<?php if ( $order->get_payment_method_title() ) : ?>
							<li class="woocommerce-order-overview__payment-method method my-2 d-flex justify-content-between">
								<strong><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?></strong>
								<span class="text-right"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
							</li>
						<?php endif; ?>
					</ul>
				
					<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
					
				</div>
				<div class="col-md-6 pl-lg-4">
				<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
				</div>
			</div>

			

		<?php endif; ?>

		

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
