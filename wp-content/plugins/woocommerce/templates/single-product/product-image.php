<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
global $product;
$gallery_thumbnail_id = $product->get_gallery_image_ids();

if ( $post_thumbnail_id ) {
	if( count($gallery_thumbnail_id) == 0 ){
		echo '<div class="single-img">';
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); 

			do_action( 'woocommerce_product_thumbnails' );
		echo "</div>";
		?>
		
	<?php } else { ?>
		<div class="gallary-product <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;"> 
			<div class="slider-for mb-2"><?php do_action( 'woocommerce_product_thumbnails' ); ?></div>
			<div class="slider-nav"><?php do_action( 'woocommerce_product_thumbnails' ); ?></div>
		</div>
	<?php
	}
} else {
	$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
	$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image img-fluid" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
	$html .= '</div>';
	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
}

$product_tskthuat = get_post_meta( $product->get_id(), '_bhww_tskthuat_wysiwyg', true );
if ( ! empty( $product_tskthuat ) ) {
	echo'<div data-toggle="modal" data-target="#tsokthuat" class="text-12 text-center cursor-pointer"><i class="fa fa-info-circle" aria-hidden="true"></i><br>Xem thông<br>số kỹ thuật</div>';
	echo '<div class="clearfix"></div>';
	// Modal
	echo '<div class="modal fade modal-general" id="tsokthuat" tabindex="-1" role="dialog" aria-labelledby="tsokthuatTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header align-items-center pb-2">
					<div class="modal-title text-uppercase font-weight-bold">Thông số kỹ thuật</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">';
					// Updated to apply the_content filter to WYSIWYG content
					echo apply_filters( 'the_content', $product_tskthuat );
				echo '</div>
			</div>
		</div>
	</div>';
}
$product_ddnbat = get_post_meta( $product->get_id(), '_bhww_ddnbat_wysiwyg', true );
if ( ! empty( $product_ddnbat ) ) {
	echo '<div class="my-3 ddnbat"><p class="text-uppercase mb-2"><strong>Đặc điểm nổi bật</strong></p>';
		echo apply_filters( 'the_content', $product_ddnbat );
	echo '</div>';
}
?>

