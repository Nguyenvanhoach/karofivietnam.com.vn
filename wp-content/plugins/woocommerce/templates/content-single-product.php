<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="bg-white p-3 mb-4">
		<div class="row">
			<div class="col-lg-4">
				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
			<div class="col-lg-5 px-lg-0">
				<div class="summary entry-summary">
					<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
					echo '<div class="my-3 my-md-4 text-center"><div class="btn btn-tuvan tuvan2 px-4 px-lg-5 w-100" data-toggle="modal" data-target="#modalbaogia"><b class="d-block font-weight-bold text-uppercase text-16"><i class="fas fa-phone-square-alt tracking-tuvan"></i>  Yêu Cầu Gọi Tư Vấn Trực Tiếp</b><span>(tư vấn viên gọi lại cho quý khách trong vòng 5 phút)</span></div></div>';
					echo '<div class="text-action border p-2">
					<span>
						Cam kết sản phẩm <strong style="color: #f90011;">chính hãng 100%</strong>, Sản phẩm được kiểm soát chất lượng bởi các chuyên gia Karofi. Áp dụng cho toàn bộ sản phẩm. <a style="color: #165fe6" target="_blank" rel="nofollow" href="'.get_bloginfo( 'url' ).'/chinh-sach-bao-hanh">Chính sách bảo hành</a> và <a style="color: #165fe6" target="_blank" rel="nofollow" href="'.get_bloginfo( 'url' ).'/chinh-sach-doi-tra-hang">chính sách đổi trả hàng</a>    
					</span>
				</div>';
					?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="static-policy p-2 border rounded mb-3">
					<div class="content-policy">
						<h4 class="text-center text-uppercase">YÊN TÂM MUA SẮM ONLINE</h4>
						<ul class="policy_list list-unstyled mb-0">
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/lapdat.png" alt=""></span>
								<p> Bảo trì trọn đời, tặng thêm <font color="2185c2"><b>1 năm</b> </font> bảo hành an tâm sử dụng
								</p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/doimoi.png" alt=""></span>
								<p><font color="2185c2"><b>Miễn phí</b></font> giao hàng lắp đặt tại nhà</p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/doitra.png" alt=""></span>
								<p><font color="2185c2"><b>Linh kiện sẵn</b></font> có tại hệ thống nhà máy Karofi toàn quốc</p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/baohanh.png" alt=""></span>
								<p> Nhận hàng thanh toán <font color="2185c2"><b>yên tâm mua sắm online </b></font></p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/doingulapdat.png" alt=""></span>
								<p> Đảm bảo hàng chính hãng <font color="2185c2"><b>tập đoàn Karofi</b></font></p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/baohanhtainoi.png" alt=""></span>
								<p>Được kiểm định chất lượng theo tiêu chuẩn quốc tế</p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/baohanhlapdat.png" alt=""></span>
								<p>Hàng việt nam <font color="2185c2"><b>chất lượng cao</b></font></p>
							</li>
						</ul>
					</div>
				</div>
				<ul class="hotline-sale list-unstyled m-0 border rounded py-2">
					<li class="title">
						<b>Gọi ngay! Sẽ có giá tốt hơn</b>
					</li>
					<li class="sale-item">
						<span>
							<i class="fas fa-phone-volume red"></i> &nbsp;Hotline: <a href="tel:0936275345" class="track-hotline-sp"><b class="red">0936.275.345</b></a>
						</span>
					</li>
				</ul>        
			</div>
		</div>
	</div>
		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
<?php do_action( 'woocommerce_after_single_product' ); ?>
</div>

<?php 
	echo productView();
?>