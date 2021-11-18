<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="text-center mt-4 mt-md-5 mb-3">
	<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn checkout-button button alt wc-forward py-3 px-5 text-uppercase rounded-0 text-center">
		<?php esc_html_e( 'Thanh toán ngay', 'woocommerce' ); ?>
	</a>
</div>
