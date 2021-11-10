<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
setPostViews(get_the_ID());
$catalog = get_the_category();
$cat_slug = $catalog[0]->slug;
$catID_now = $catalog[0]->cat_ID;
$catID = 1;
?>
<div class="wrap-crumbs container my-3"><?php if(function_exists('breadcrumb')){breadcrumb();} ?></div>
<div class="container">
	<div class="row mb-3">
			<div class="col-md-8 col-lg-9">
				<ul class="nav nav-news mb-5">
          <li class="nav-item pr-3">
            <a title="Tin tức mới" class="text-uppercase px-0  nav-link <?php if($cat_slug == 'tin-tuc') {echo "active";}?>" href="<?php echo get_term_link($catID, 'category'); ?>">Tin tức mới</a>
          </li>			
          <?php
            $categories=get_categories(	array( 'parent' => $catID )	);
          foreach ($categories as $c) {
            $active = '';
            if($c->slug == $cat_slug) {$active = 'active';}
            echo '<li class="nav-item px-3"><a class="nav-link text-uppercase px-0 '.$active.'" href="'. get_term_link($c->slug, 'category') .'" title="'.$c->cat_name.'">'.$c->cat_name.'</a></li>';
          }
          ?>
        </ul>
        <div class="bg-white p-3">
					<?php
						if ( have_posts() ) {

							while ( have_posts() ) {
								the_post();

								get_template_part( 'template-parts/content', get_post_type() );
							}
						}
						if(function_exists('yeucauBaoGiaForm')){yeucauBaoGiaForm();}
						if(function_exists('share_social')){share_social();}
						if(function_exists('related_posts')){echo '<hr>';related_posts();}
					?>          
        </div>
			</div>
			<div class="col-md-4 col-lg-3 pl-md-0">
				<div class="bg-white p-2">
					<?php if(function_exists('newsViewMore')){newsViewMore();} ?>				
					
					<h3 class="title-right font-weight-bold text-uppercase">TIN XEM NHIỀU</h3>
				</div>
			</div>
		</div>
		<div class="product-review bg-white py-3 mb-3">		
			<h3 class="text-20 text-uppercase font-weight-bold mb-3 pl-3">Sản phẩm đã xem</h3>			
			<div class="product-list clearfix">
				<div class="row mx-0">
					<div class="col-6 col-sm-4 col-md-3 col-lg-cs-5 prod-num-1 py-3">
						<div class="item">
							<a class="d-block img-cat position-relative" href="" title="">
								<img src="https://iq-house.vn/wp-content/uploads/2021/06/vlc397-cau-2-khoi-2997.jpg" class="img-fluid" alt="" loading="lazy">
								<span class="onsale">- 13%</span>
							</a>
							<a class="d-block" href="https://iq-house.vn/san-pham/bo-bon-cau-2-khoi-cao-cap-vl-c397/" title="Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397">
								<h3 class="title-product-home">Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397</h3>
							</a>
							<div class="wrap-price"><ins><span class="woocommerce-Price-amount amount"><bdi>2.850.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></ins><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>3.223.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></del></div>
							<div class="txt-promo">Tặng quạt điều hòa Karofi KAC - E132 trị trá 4.760.000Đ</div>
						</div>
					</div>
					<div class="col-6 col-sm-4 col-md-3 col-lg-cs-5 prod-num-1 py-3">
						<div class="item">
							<a class="d-block img-cat position-relative" href="" title="">
								<img src="https://karofivietnam.com.vn/media/product/225_d66_kms.jpg" class="img-fluid" alt="" loading="lazy">
								<span class="onsale">- 13%</span>
							</a>
							<a class="d-block" href="https://iq-house.vn/san-pham/bo-bon-cau-2-khoi-cao-cap-vl-c397/" title="Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397">
								<h3 class="title-product-home">Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397</h3>
							</a>
							<div class="wrap-price"><ins><span class="woocommerce-Price-amount amount"><bdi>2.850.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></ins><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>3.223.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></del></div>
							<div class="txt-promo">Tặng quạt điều hòa Karofi KAC - E132 trị trá 4.760.000Đ</div>
						</div>
					</div>
					<div class="col-6 col-sm-4 col-md-3 col-lg-cs-5 prod-num-1 py-3">
						<div class="item">
							<a class="d-block img-cat position-relative" href="" title="">
								<img src="https://iq-house.vn/wp-content/uploads/2021/06/vlc397-cau-2-khoi-2997.jpg" class="img-fluid" alt="" loading="lazy">
								<span class="onsale">- 13%</span>
							</a>
							<a class="d-block" href="https://iq-house.vn/san-pham/bo-bon-cau-2-khoi-cao-cap-vl-c397/" title="Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397">
								<h3 class="title-product-home">Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397</h3>
							</a>
							<div class="wrap-price"><ins><span class="woocommerce-Price-amount amount"><bdi>2.850.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></ins><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>3.223.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></del></div>
							<div class="txt-promo">Tặng quạt điều hòa Karofi KAC - E132 trị trá 4.760.000Đ</div>
						</div>
					</div>
					<div class="col-6 col-sm-4 col-md-3 col-lg-cs-5 prod-num-1 py-3">
						<div class="item">
							<a class="d-block img-cat position-relative" href="" title="">
								<img src="https://iq-house.vn/wp-content/uploads/2021/06/vlc397-cau-2-khoi-2997.jpg" class="img-fluid" alt="" loading="lazy">
								<span class="onsale">- 13%</span>
							</a>
							<a class="d-block" href="https://iq-house.vn/san-pham/bo-bon-cau-2-khoi-cao-cap-vl-c397/" title="Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397">
								<h3 class="title-product-home">Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397</h3>
							</a>
							<div class="wrap-price"><ins><span class="woocommerce-Price-amount amount"><bdi>2.850.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></ins><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>3.223.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></del></div>
							<div class="txt-promo">Tặng quạt điều hòa Karofi KAC - E132 trị trá 4.760.000Đ</div>
						</div>
					</div>
					<div class="col-6 col-sm-4 col-md-3 col-lg-cs-5 prod-num-1 py-3">
						<div class="item">
							<a class="d-block img-cat position-relative" href="" title="">
								<img src="https://iq-house.vn/wp-content/uploads/2021/06/vlc397-cau-2-khoi-2997.jpg" class="img-fluid" alt="" loading="lazy">
								<span class="onsale">- 13%</span>
							</a>
							<a class="d-block" href="https://iq-house.vn/san-pham/bo-bon-cau-2-khoi-cao-cap-vl-c397/" title="Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397">
								<h3 class="title-product-home">Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397</h3>
							</a>
							<div class="wrap-price"><ins><span class="woocommerce-Price-amount amount"><bdi>2.850.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></ins><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>3.223.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></del></div>
							<div class="txt-promo">Tặng quạt điều hòa Karofi KAC - E132 trị trá 4.760.000Đ</div>
						</div>
					</div>
					<div class="col-6 col-sm-4 col-md-3 col-lg-cs-5 prod-num-1 py-3">
						<div class="item">
							<a class="d-block img-cat position-relative" href="" title="">
								<img src="https://iq-house.vn/wp-content/uploads/2021/06/vlc397-cau-2-khoi-2997.jpg" class="img-fluid" alt="" loading="lazy">
								<span class="onsale">- 13%</span>
							</a>
							<a class="d-block" href="https://iq-house.vn/san-pham/bo-bon-cau-2-khoi-cao-cap-vl-c397/" title="Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397">
								<h3 class="title-product-home">Bộ Bồn Cầu 2 Khối Cao Cấp VL-C397</h3>
							</a>
							<div class="wrap-price"><ins><span class="woocommerce-Price-amount amount"><bdi>2.850.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></ins><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>3.223.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></del></div>
							<div class="txt-promo">Tặng quạt điều hòa Karofi KAC - E132 trị trá 4.760.000Đ</div>
						</div>
					</div>           

				</div>    
			</div>
		</div>		
</div><!-- #site-content -->

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
