<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
	<form class="woocommerce-ordering" method="get">
		<div class="d-flex align-items-center justify-content-between ordering-sort py-2 py-md-0">
			<div class="filter-prod d-md-none w-50 px-2 py-1 mx-1 mx-md-0 text-center rounded">
				<i class="fas fa-filter"></i> Lọc
			</div>
			<div class="d-flex flex-column flex-md-row align-items-md-center mx-1 mx-md-0">
				<span class="text-nowrap pr-2 font-weight-bold mb-1 mb-md-0 d-none d-md-inline-block">Sắp xếp theo</span>
				<select name="orderby" class="orderby form-control" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
					<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
						<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
					<?php endforeach; ?>
				</select>
				<input type="hidden" name="paged" value="1" />
			</div>
			<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
		</div>
	</form>
</div>
