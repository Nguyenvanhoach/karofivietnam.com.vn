<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri();?>/assets/images/favicon.png" type="image/x-icon">
		<meta name="description" content="<?php bloginfo('description'); ?>" />
		<?php wp_head();
			//echo '<link href="'.get_template_directory_uri().'/assets/revslider/settings.css" type="text/css" rel="stylesheet" media="screen" />';
			if (is_home() || is_front_page()) {
			echo '<meta property="og:image" content="'.get_template_directory_uri().'/assets/images/thumbnail.jpg"> ';    
			}
		?>
	</head>

	<body <?php body_class(); ?>>
		<?php
		wp_body_open();
		?>

	<header class="header" id="header">
		<div class="header-top d-none d-md-block">
			<div class="container">
				<div class="row">
					<div class="col pr-0"><a class="d-block" href="<?php bloginfo('url'); ?>" title="<?php echo get_bloginfo( 'name' ); ?>"><img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/banner-top_1.jpg" class="img-fluid d-block" alt="<?php echo get_bloginfo( 'name' ); ?>"></a></div>
					<div class="col px-0"><a class="d-block" href="<?php bloginfo('url'); ?>" title="<?php echo get_bloginfo( 'name' ); ?>"><img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/banner-top_2.jpg" class="img-fluid d-block" alt="<?php echo get_bloginfo( 'name' ); ?>"></a></div>
					<div class="col pl-0"><a class="d-block" href="<?php bloginfo('url'); ?>" title="<?php echo get_bloginfo( 'name' ); ?>"><img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/banner-top_3.jpg" class="img-fluid d-block" alt="<?php echo get_bloginfo( 'name' ); ?>"></a></div>
				</div>
			</div>
		</div>
		<div class="header-top-2 py-2">
			<div class="container">
				<div class="row align-items-center justify-content-between">
					<div class="title-special">
						<?php
							if (is_home() || is_front_page()) {
								echo '<a href="https://karofivietnam.com.vn/" class="pl-0"><h1 class="text-14 m-0"><i class="far fa-dot-circle yellow font-weight-bold"></i><b class="red"> Máy lọc nước Karofi chính hãng giá rẻ Tặng quạt điều hòa</b></h1></a>';
							} else if(is_tax()) {
								$taxonomy 	= get_taxonomy ( get_query_var('taxonomy') );
								$page= get_page_by_title($taxonomy->label, 'OBJECT', 'page');
								$term = get_term_by('slug',get_query_var('term') , $taxonomy->name);
								// $output .='<a rel="nofollow" href="'.  get_permalink($page->ID) . '">'. $taxonomy->label.'</a> ';
								$terms = array($term);
								while($term->parent){
									$term =get_term($term->parent	, $term->taxonomy );
									$terms [] =$term ;
								}
								$terms = array_reverse($terms);
								for ($i=0;$i<count($terms);$i++)
								{
									$link = get_term_link($terms[$i]);
									if($i+1==count($terms))
									{
										echo '<a href="' . $link . '" title="' . $terms[$i]->name .'" class="pl-0"><h1 class="text-14 m-0"><i class="far fa-dot-circle yellow font-weight-bold"></i><b class="red"> ' . $terms[$i]->name .'</b></h1></a>';
									}
								}
							} else {
								echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="pl-0"><h1 class="text-14 m-0"><i class="far fa-dot-circle yellow font-weight-bold"></i><b class="red"> ' . get_the_title() .'</b></h1></a>';
							}
						?>
						
					</div>
					<div class="d-none d-md-block">
						<ul class="list-inline text-right mb-0">
							<li class="list-inline-item px-2 px-lg-3"><a class="text-capitalize" href="<?php echo get_bloginfo( 'url' );?>/gioi-thieu" title="Giới thiệu">Giới thiệu</a></li>
							<li class="list-inline-item px-2 px-lg-3"><a class="text-capitalize" href="<?php echo get_bloginfo( 'url' );?>/phuong-thuc-thanh-toan" title="Phương thức thanh toán">Phương thức thanh toán</a></li>
							<li class="list-inline-item px-2 px-lg-3"><a class="text-capitalize" href="<?php echo get_bloginfo( 'url' );?>/chinh-sach-bao-hanh" title="Chính sách bảo hành">Chính sách bảo hành</a></li>
							<li class="list-inline-item pl-2 pl-lg-3"><a class="text-capitalize" href="<?php echo get_bloginfo( 'url' );?>/lien-he" title="Liên hệ">Liên hệ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="header-middle">
			<div class="header-fixed py-1 py-md-3">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-6 col-md-3">
							<h1 class="logo m-0 d-block"><span class="text-logo"><?php bloginfo('description'); ?></span><a class="d-block wrap-logo" href="<?php bloginfo('url'); ?>" title="<?php echo get_bloginfo( 'name' ); ?>"><img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/logo.png" class="img-fluid d-block rounded" alt="<?php echo get_bloginfo( 'name' ); ?>"></a></h1>
						</div>
						<div class="col-6 col-md col-lg col-mb">
							<div class="d-flex align-items-center justify-content-end">
								<div class="search-header search-area d-inline-block">	
									<i data-click class="fas fa-search d-md-none"></i>							
									<div class="inner-search">
										<form role="search" method="get" class="woocommerce-product-search position-relative py-3 px-4 p-md-0" action="<?php echo esc_url( home_url( '/' ) ); ?>">
											<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field form-control" placeholder="<?php echo esc_attr__( 'Bạn cần tìm gì', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
											<button class="btn btn-searchbox px-3 px-md-2 px-lg-3" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>"><i class="fas fa-search"></i></button>
											<input type="hidden" name="post_type" value="product" />
										</form>
									</div>
								</div>
								<?php
									if(get_option('hotline') !='') {
										echo '<a href="tel:'.get_option('hotline').'" title="'.get_option('hotline').'" class="media area-icon-top d-none d-md-flex ml-3 ml-md-5 color-3"><div class="icon-c d-flex align-items-center justify-content-center"><img loading="lazy" src="'.get_template_directory_uri().'/assets/images/hotline-top.png" class="img-fluid d-block" alt="Hotline"></div><div class="media-body ml-2 lh-18"><strong>Hotline</strong><div class="hotline font-weight-bold">'.get_option('hotline').'</div></div></a>';
									}
								?>
								<div class="minicart-header position-relative ml-3 ml-md-4">
										<div class="counter qty empty d-flex lh-18"><i class="fas fa-shopping-cart mr-1 mr-md-2"></i><span class="counter-number d-flex align-items-center"><span><strong class="d-none d-lg-block">Giỏ hàng</strong><?php echo sprintf (_n( '<span class="d-none d-lg-inline-block">Sản phẩm</span> <strong><span class="d-none d-lg-inline-block">(</span>%d<span class="d-none d-lg-inline-block">)</span></strong>', '<span class="d-none d-lg-inline-block">Sản phẩm</span> <strong><span class="d-none d-lg-inline-block">(</span>%d<span class="d-none d-lg-inline-block">)</span></strong>', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></span><i class="ml-1 fas fa-caret-down ml-lg-1 d-none d-lg-inline-block"></i></span></div>  
									<?php if ( WC()->cart->is_empty() ) { ?>             
										<div class="block-minicart empty">
											<div class="inner-minicart">
												<div class="block-content p-3 p-md-4 text-center text-capitalize"><strong>Không có sản phẩm nào ở trong giỏ hàng của bạn.</strong></div>                      
											</div>
										</div>
									<?php }else {?>
										<div class="block-minicart">
										<div class="inner-minicart px-3 py-3">
										<!--  <h4>Đơn hàng của bạn (<span class="count_items"><?php echo WC()->cart->get_cart_contents_count() ?></span>)</h4> -->
											<div class="block-content">
											<ul class="list-unstyled cart-list">
												<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { $_product = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['data'], $cart_item, $cart_item_key ); $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key ); if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) { $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key ); } ?>
													<li>
													<div class="wrap-thumb-img"><?php $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); if ( ! $product_permalink ) { echo $thumbnail; } else { printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); } ?></div>
													<div class="detail-cart">
														<span class="title"> 
															<?php echo $_product->get_name() ?> 
															<?php
																echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
																	'woocommerce_cart_item_remove_link',
																	sprintf(
																		'<a href="%s" class="delete remove-cart-items remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><strong>&times;</strong></a>',
																		esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
																		esc_html__( 'Remove this item', 'woocommerce' ),
																		esc_attr( $product_id ),
																		esc_attr( $_product->get_sku() )
																	),
																	$cart_item_key
																);
															?>
														</span>

														<div id="span-cart"> <?php if ( $_product->is_sold_individually() ) { $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key ); } else { $product_quantity = $cart_item['quantity']; }echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); ?> x <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></div>
													</div>
													</li>
												<?php } ?>
												<li><span class="price-cart d-flex"><span class="pr-2">Tổng tiền tạm tính:</span><span class="price ml-auto font-weight-bold"><?php echo WC()->cart->get_cart_total(); ?></span></span> </li>
											</ul>
											<div class="d-flex align-items-center justify-content-between"> 
												<a href="<?php echo WC()->cart->get_cart_url(); ?>" title="Giỏ hàng" class="btn btn-g text-capitalize mr-1 mr-md-2 w-50">Giỏ hàng</a>
												<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn-g btn alt wc-forward text-capitalize ml-1 ml-md-2 w-50"><?php esc_html_e( 'Thanh Toán', 'woocommerce' ); ?></a>
											</div>
											</div>
										</div>
										</div>
									<?php } ?>
								</div>
								<button type="button" class="navbar-toggler btn-m d-block d-md-none ml-4 text-right"><span class="burger"><span data-v-507bd8df=""></span></span></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-nav">
				<div class="container">
					<div class="row">
						<div class="col-3 cus-col-3 pr-0 wrap-dm">
							<div class="dmuc px-2 px-md-2 d-none d-md-block"><i class="fa fa-bars mr-1"></i> DANH MỤC SẢN PHẨM </div>
							<!-- <div class="col-3 cus-col-3 pr-0"> -->
							<div class="position-relative">
								<div class="list-dm">
									<?php 
										$taxonomy = 'product_cat';
										$args = array('taxonomy'     => $taxonomy,'hide_empty' => false,'orderby'   => 'date','order' => 'ASC');
										$all_categories = get_categories( $args );
										if ( $all_categories && !is_wp_error( $all_categories ) ) {   
											foreach ($all_categories as $cat) {
												if($cat->category_parent == 0 && $cat->slug != 'san-pham-xa-hang' && $cat->slug != 'khuyen-mai-soc-trong-thang') {
													$category_id = $cat->term_id;  
													$args2 = array('taxonomy'=> $taxonomy,'child_of'=> 0,'parent'=> $category_id,'hide_empty' => false,'orderby'   => 'date','order' => 'ASC');
													$sub_cats = get_categories( $args2 );
													if($sub_cats) {
														echo '<div class="item hasChild"><a href="'. get_term_link($cat->slug, 'product_cat') .'" title="'.$cat->name.'"><img loading="lazy" src="'.get_template_directory_uri().'/assets/images/'.$cat->slug.'.jpg" alt="'.$cat->name.'" class="cate-img"><span>'.$cat->name.'</span><i class="icon_child"></i></a>';
															echo '<div class="sub-menu width-1-col"><div class="list"><div class="col">';
																foreach($sub_cats  as $key => $sub_category) { 
																	$category_id = $sub_category->term_id; 
																	echo '<div class="sub-menu2"><div class="item-sub">';
																		$args3 = array('taxonomy'=> $taxonomy,'child_of'=> 0,'parent'=> $category_id,'hide_empty' => false,'orderby'   => 'date','order' => 'ASC');
																		$sub_cats3 = get_categories( $args3 );
																		if($sub_cats3) {
																			echo '<a href="'.get_term_link($sub_category->slug, $taxonomy).'" title="'.$sub_category->name.'" class="has-submenu">'.$sub_category->name.'<i class="icon_child"></i></a>';
																			echo '<div class="list-sub-hover">';
																				foreach($sub_cats3  as $key => $sub_category3) { 
																					echo '<a class="sub3" href="'.get_term_link($sub_category3->slug, $taxonomy).'" title="'.$sub_category3->name.'">'.$sub_category3->name.'</a>';
																				}
																			echo '</div>';
																		} else {
																			echo '<a href="'.get_term_link($sub_category->slug, $taxonomy).'" title="'.$sub_category->name.'">'.$sub_category->name.'</a>';
																		} 
																	echo '</div></div>';
																}
															echo '</div></div></div>';
														echo '</div>';
													} else {
														echo '<div class="item"><a href="'. get_term_link($cat->slug, 'product_cat') .'" title="'.$cat->name.'"><img loading="lazy" src="'.get_template_directory_uri().'/assets/images/'.$cat->slug.'.jpg" alt="'.$cat->name.'" class="cate-img"><span>'.$cat->name.'</span></a></div>';
													}
												}
											}
										}
									?>
								</div>
							</div>			
						</div>
						<div class="col-9 px-md-1 d-none d-md-block">
							<div id="nav-right" class="d-flex align-items-center justify-content-between">
							<a href="<?php echo get_bloginfo( 'url' );?>/product-category/khuyen-mai-soc-trong-thang/" class="item" title="KHUYẾN MÃI THÁNG <?php echo date('m');?>"> 
								<div class="pulse-icon"><div class="icon-wrap"></div><div class="elements"><div class="pulse pulse-1"></div></div></div>KHUYẾN MÃI THÁNG <?php echo date('m');?>
							</a>
							<a href="<?php echo get_bloginfo( 'url' );?>/tin-tuc/sua-may-loc-nuoc/" class="item" title="SỬA MÁY LỌC NƯỚC"><i class="fas fa-bolt"></i>SỬA MÁY LỌC NƯỚC</a>
							<a href="<?php echo get_bloginfo( 'url' );?>/tin-tuc/thay-loi-loc-nuoc/" class="item" title="THAY LÕI LỌC NƯỚC"><i class="fas fa-fire"></i>THAY LÕI LỌC NƯỚC</a>
							<a href="<?php echo get_bloginfo( 'url' );?>/he-thong-phan-phoi-karofi/" class="item" title="HỆ THỐNG PHÂN PHỐI"><i class="fas fa-fire"></i>HỆ THỐNG PHÂN PHỐI</a>
							<a href="<?php echo get_bloginfo( 'url' );?>/tin-tuc" class="item" title="TIN TỨC"><i class="fas fa-bolt"></i>TIN TỨC</a>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</header>
