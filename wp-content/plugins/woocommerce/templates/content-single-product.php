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
			<div class="col-lg-4 mb-3 mb-md-0">
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
					echo '<div class="my-2 text-center"><div class="btn btn-tuvan tuvan2 px-4 px-lg-5 w-100" data-toggle="modal" data-target="#modalbaogia"><b class="d-block font-weight-bold text-uppercase text-16"><i class="fas fa-phone-square-alt tracking-tuvan"></i>  Y??u C???u G???i T?? V???n Tr???c Ti???p</b><span>(t?? v???n vi??n g???i l???i cho qu?? kh??ch trong v??ng 5 ph??t)</span></div></div>';
					echo '<div class="text-action border p-2 mb-3 mb-md-0">
					<span>
						Cam k???t s???n ph???m <strong style="color: #f90011;">ch??nh h??ng 100%</strong>, S???n ph???m ???????c ki???m so??t ch???t l?????ng b???i c??c chuy??n gia Karofi. ??p d???ng cho to??n b??? s???n ph???m. <a style="color: #165fe6" target="_blank" rel="nofollow" href="'.get_bloginfo( 'url' ).'/chinh-sach-bao-hanh">Ch??nh s??ch b???o h??nh</a> v?? <a style="color: #165fe6" target="_blank" rel="nofollow" href="'.get_bloginfo( 'url' ).'/chinh-sach-doi-tra-hang">ch??nh s??ch ?????i tr??? h??ng</a>    
					</span>
				</div>';
					?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="static-policy p-2 border rounded mb-3">
					<div class="content-policy">
						<h4 class="text-center text-uppercase">Y??N T??M MUA S????M ONLINE</h4>
						<ul class="policy_list list-unstyled mb-0">
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/lapdat.png" alt=""></span>
								<p> B???o tr?? tr???n ?????i, t???ng th??m <font color="2185c2"><b>1 n??m</b> </font> b???o h??nh an t??m s??? d???ng
								</p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/doimoi.png" alt=""></span>
								<p><font color="2185c2"><b>Mi???n ph??</b></font> giao h??ng l???p ?????t t???i nh??</p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/doitra.png" alt=""></span>
								<p><font color="2185c2"><b>Linh ki???n s???n</b></font> c?? t???i h??? th???ng nh?? m??y Karofi to??n qu???c</p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/baohanh.png" alt=""></span>
								<p> Nh???n h??ng thanh to??n <font color="2185c2"><b>y??n t??m mua s???m online </b></font></p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/doingulapdat.png" alt=""></span>
								<p> ?????m b???o h??ng ch??nh h??ng <font color="2185c2"><b>t???p ??o??n Karofi</b></font></p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/baohanhtainoi.png" alt=""></span>
								<p>???????c ki???m ?????nh ch???t l?????ng theo ti??u chu???n qu???c t???</p>
							</li>
							<li><span><img class="img-fluid" loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/baohanhlapdat.png" alt=""></span>
								<p>H??ng vi???t nam <font color="2185c2"><b>ch???t l?????ng cao</b></font></p>
							</li>
						</ul>
					</div>
				</div>
				<ul class="hotline-sale list-unstyled m-0 border rounded py-2">
					<li class="title">
						<b>G???i ngay! S??? c?? gi?? t???t h??n</b>
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
<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content rounded-0">
			<div class="modal-body p-0">
				<button type="button" class="btn btn-close d-flex align-items-center justify-content-center" data-dismiss="modal"><span aria-hidden="true">??</span><span class="sr-only">Close</span></button>
				<img id="image-gallery-image" class="img-fluid mx-auto d-block" src="">
				<button type="button" class="btn btn-secondary btn-arrow btn-prev" id="show-previous-image"><i class="fa fa-arrow-left"></i></button>
				<button type="button" id="show-next-image" class="btn btn-secondary btn-arrow btn-next"><i class="fa fa-arrow-right"></i></button>
			</div>
		</div>
	</div>
</div>