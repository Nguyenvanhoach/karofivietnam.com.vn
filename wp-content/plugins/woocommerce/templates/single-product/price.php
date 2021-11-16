<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$stock_p = $product->managing_stock();

?>
<hr class="my-2">
<div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price mb-4' ) ); ?>"><?php 
	if ( $product->price > 0 ) {
		if ( $product->price && isset( $product->regular_price ) ) {
			$from = $product->regular_price;
			$to = $product->price;
			echo '<div class="wrap-price mb-2"><span class="pr-2 pr-lg-3 price-sale">Giá khuyến mãi: '.( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) .'</span>Giá thị trường:<del>'. ( ( is_numeric( $from ) ) ? woocommerce_price( $from ) : $from ) .'</del></div>';
		} else {
			$to = $product->price;
			echo '<div class="wrap-price mb-2">Giá: ' . ( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) . '</div>';
		}
	} else {
	 echo '<div class="wrap-price mb-2">Liên hệ</div>';
	}

	//echo $product->get_price_html(); 
	if( $product->is_type('variable')){
		$percentages = array();
		// Get all variation prices
		$prices = $product->get_variation_prices();

		// Loop through variation prices
		foreach( $prices['price'] as $key => $price ){
				// Only on sale variations
				if( $prices['regular_price'][$key] !== $price ){
						// Calculate and set in the array the percentage for each variation on sale
						$percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
				}
		}
		$percentage = max($percentages) . '%';
} else {
		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();

		$percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
}
echo '<div class="discount-pdetail">Tiết kiệm:' . esc_html__( ' ', 'woocommerce' ) . '<span class="lable-discount">- ' . $percentage . '</span></div>';
?>
</div>

<ul class="mb-3 pl-3 att-product clearfix">                
	<li> <b class="red">Thương hiệu</b>: Karofi</li>
	
	<?php
		$baohanh = get_post_meta( get_the_ID(), 'baohanh', true );
		$kieudang = get_post_meta( get_the_ID(), 'kieudang', true );
		if($baohanh) {
			echo '<li> <b class="red">Bảo hành</b>: '.$baohanh.' </li>';
		}
	?>
	
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<li><b class="red"><?php esc_html_e( 'Model:', 'woocommerce' ); ?></b> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>
		</li>
	<?php endif; 
		if($kieudang) {
			echo '<li> <b class="red">Kiểu dáng</b>: '.$kieudang.' </li>';
		}
	?>
</ul>

<?php 
	if($stock_p == true){
		echo '<div class="color-green font-weight-bold text-uppercase mb-3">Còn hàng</div>';
	} else {
		echo '<div class="color-green font-weight-bold text-uppercase mb-3">Hết hàng</div>';
	}
?>
