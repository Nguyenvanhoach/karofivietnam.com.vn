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
			echo '<link href="'.get_template_directory_uri().'/assets/revslider/settings.css" type="text/css" rel="stylesheet" media="screen" />';
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
				<div class="row align-items-center">
					<div class="col-12 col-md-6">
						<?php
							if (is_home() || is_front_page()) {
								echo '<a href="https://karofivietnam.com.vn/" class="pl-0"><h1 class="text-14 m-0"><i class="far fa-dot-circle yellow font-weight-bold"></i><b class="red"> Máy lọc nước Karofi chính hãng giá rẻ Tặng quạt điều hòa</b></h1></a>';
							} else {
								echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="pl-0"><h1 class="text-14 m-0"><i class="far fa-dot-circle yellow font-weight-bold"></i><b class="red"> ' . get_the_title() .'</b></h1></a>';
							}
						?>
						
					</div>
					<div class="col-12 col-md-6">
						<ul class="list-inline text-right mb-0">
							<li class="list-inline-item px-2 px-md-3"><a class="text-capitalize" href="<?php echo get_bloginfo( 'url' );?>/gioi-thieu" title="Giới thiệu">Giới thiệu</a></li>
							<li class="list-inline-item px-2 px-md-3"><a class="text-capitalize" href="<?php echo get_bloginfo( 'url' );?>/phuong-thuc-thanh-toan" title="Phương thức thanh toán">Phương thức thanh toán</a></li>
							<li class="list-inline-item px-2 px-md-3"><a class="text-capitalize" href="<?php echo get_bloginfo( 'url' );?>/chinh-sach-bao-hanh" title="Chính sách bảo hành">Chính sách bảo hành</a></li>
							<li class="list-inline-item pl-2 pl-md-3"><a class="text-capitalize" href="<?php echo get_bloginfo( 'url' );?>/lien-he" title="Liên hệ">Liên hệ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="header-middle">
			<div class="header-fixed py-2 py-md-3">
				<div class="container">
					<div class="row">
						<div class="col-3">
							<h1 class="logo m-0 d-block"><span class="text-logo"><?php bloginfo('description'); ?></span><a class="d-block wrap-logo" href="<?php bloginfo('url'); ?>" title="<?php echo get_bloginfo( 'name' ); ?>"><img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/logo.png" class="img-fluid d-block rounded" alt="<?php echo get_bloginfo( 'name' ); ?>"></a></h1>
						</div>
						<div class="col">
							<div class="d-flex align-items-center justify-content-end">
								<div class="search-header search-area mr-4 mr-md-0 d-inline-block">								
									<div class="inner-search">
										<form role="search" method="get" class="woocommerce-product-search position-relative py-3 px-4 p-md-0" action="<?php echo esc_url( home_url( '/' ) ); ?>">
											<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field form-control" placeholder="<?php echo esc_attr__( 'Bạn cần tìm gì', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
											<button class="btn btn-searchbox px-2 px-lg-3" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>"><i data-click class="fas fa-search"></i></button>
											<input type="hidden" name="post_type" value="product" />
										</form>
									</div>
								</div>
								<?php
									if(get_option('phone_company') !='') {
										echo '<a href="tel:'.get_option('phone_company').'" title="'.get_option('phone_company').'" class="media area-icon-top d-none d-md-flex ml-3 ml-md-5 color-3"><div class="icon-c d-flex align-items-center justify-content-center"><img loading="lazy" src="'.get_template_directory_uri().'/assets/images/hotline-top.png" class="img-fluid d-block" alt="Hotline"></div><div class="media-body ml-2 lh-18"><strong>Hotline</strong><div class="hotline font-weight-bold">'.get_option('phone_company').'</div></div></a>';
									}
								?>
								<div class="minicart-header position-relative ml-3 ml-md-4">
										<div class="counter qty empty d-flex lh-18"><i class="fas fa-shopping-cart mr-1 mr-md-2"></i><span class="counter-number d-flex align-items-center"><span><strong class="d-block">Giỏ hàng</strong><?php echo sprintf (_n( '<span class="d-none d-md-inline-block">Sản phẩm</span> <strong>( %d )</strong>', '<span class="d-none d-md-inline-block">Sản phẩm</span> <strong>( %d )</strong>', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></span>&nbsp;<i class="fas fa-caret-down ml-1"></i></span></div>  
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
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-nav">
				<div class="container">
					<div class="row">
						<div class="col-3 cus-col-3 pr-0 wrap-dm">
							<div class="dmuc px-2 px-md-2"><i class="fa fa-bars mr-1"></i> DANH MỤC SẢN PHẨM </div>
							<!-- <div class="col-3 cus-col-3 pr-0"> -->
							<div class="position-relative">
								<div class="list-dm">
									<div class="item">
										<a href=""><img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/may-loc-nuoc-tu-dung.jpg" alt="" class="cate-img"><span>Máy lọc nước tủ đứng</span></a>
									</div>
									<div class="item">
										<a href=""> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/may-loc-nuoc-khong-tu-de-gam.jpg" alt="" class="cate-img"><span>Máy lọc nước không tủ để gầm</span></a>
									</div><!--item-->
									<div class="item   ">
										<a href=""> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/may-loc-nuoc-karofi-hydrogen.jpg" alt="" class="cate-img"><span>Máy lọc nước Hydrogen Karofi</span></a>
									</div><!--item-->
									<div class="item  hasChild   ">
										<a href="/.html" id="cat6"> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/may-loc-nuoc-thong-minh.jpg" alt="" class="cate-img"><span>Máy lọc nước thông minh</span></a>
										<div class="sub-menu  width-1-col ">
											<div class="list">
												<div class="col">
													
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/may-loc-nuoc-karofi-iro-11.html" class="has-submenu">Máy Lọc Nước Karofi IRO 1.1</a>
														<div class="list-sub-hover"> 
																<a href="/may-loc-nuoc-iro-khong-tu.html" class="sub3">Máy Lọc nước IRO 1.1 không tủ</a>
																<a href="/may-loc-nuoc-iro-tu-iq.html" class="sub3">Máy Lọc nước IRO 1.1 có tủ IQ</a>
														</div>
														</div>
													</div>
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/may-loc-nuoc-karofi-iro-20.html">Máy Lọc Nước Karofi IRO 2.0</a>
														
														</div>
													</div>
													
												</div>
											</div><!--list-->
										</div><!--sub-menu-->
									</div><!--item-->
									<div class="item  hasChild   ">
										<a href="/.html" id="cat24"> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/cay-nuoc-nong-lanh-karofi.jpg" alt="" class="cate-img"><span>Cây nước nóng lạnh Karofi</span></a>
										<div class="sub-menu  width-1-col ">
											<div class="list">
												<div class="col">
													
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/may-loc-nuoc-nong-lanh.html">Máy lọc nước nóng lạnh</a>
														
														</div>
													</div>
													
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/cay-nuoc-nong-lanh-hut-binh.html">Cây nước nóng lạnh hút bình</a>
														
														</div>
													</div>
													
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/cay-nuoc-nong-lanh-up-binh.html">Cây nước nóng lạnh úp bình</a>
														
														</div>
													</div>
													
												</div>
											</div><!--list-->
										</div><!--sub-menu-->
									</div><!--item-->
									<div class="item  hasChild   ">
										<a href="/.html" id="cat18"> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/may-loc-cong-suat-lon.jpg" alt="" class="cate-img"><span>Máy lọc công suất lớn</span></a>
										<div class="sub-menu  width-1-col ">
											<div class="list">
												<div class="col">
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/may-loc-nuoc-ban-cong-nghiep.html">Máy lọc nước bán công nghiệp</a>
														</div>
													</div>
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/may-loc-nuoc-cong-nghiep.html">Máy lọc nước công nghiệp</a>
														</div>
													</div>
												</div>
											</div><!--list-->
										</div><!--sub-menu-->
									</div><!--item-->
									<div class="item  hasChild   ">
										<a href="/.html" id="cat21"> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/phu-kien-may-loc-nuoc.jpg" alt="" class="cate-img"><span>Phụ kiện máy lọc nước</span></a>
										<div class="sub-menu  width-1-col ">
											<div class="list">
												<div class="col">
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/loi-loc-karofi.html">Lõi lọc nước Karofi</a>
														</div>
													</div>
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/linh-kien-phu-kien.html">Linh kiện - Phụ kiện</a>
														</div>
													</div>
												</div>
											</div><!--list-->
										</div><!--sub-menu-->
									</div><!--item-->
									<div class="item   ">
										<a href="/.html" id="cat23"> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/may-loc-khong-khi-karofi.jpg" alt="" class="cate-img"><span>Máy lọc không khí Karofi</span></a>
									</div><!--item-->
									<div class="item   ">
										<a href="/.html" id="cat28"> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/cay-nuoc-nong-lanh-korihome.jpg" alt="" class="cate-img"><span>Cây nước nóng lạnh Korihome</span></a>
									</div><!--item-->
									<div class="item   ">
										<a href="/.html" id="cat17"> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/may-loc-nuoc-korihome.jpg" alt="" class="cate-img"><span>Máy Lọc Nước KoriHome</span></a>
									</div><!--item-->
									<div class="item  hasChild ">
										<a href="/.html" id="cat11"> <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/may-loc-nuoc-karofi-optimus.jpg" alt="" class="cate-img"><span>Máy lọc nước Karofi Optimus</span></a>
										<div class="sub-menu width-1-col">
											<div class="list">
												<div class="col">                    
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/may-loc-nuoc-optimus-i1.html">Máy Lọc Nước Optimus I1</a>
														
														</div>
													</div>
													
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/may-loc-nuoc-optimus-i2.html">Máy Lọc Nước Optimus I2</a>
														
														</div>
													</div>
													
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/may-loc-nuoc-optimus-s1.html">Máy Lọc Nước Optimus S1</a>
														
														</div>
													</div>
													
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/may-loc-nuoc-optimus-plus.html">Máy lọc nước Optimus PLUS</a>
														
														</div>
													</div>
													
												</div>
											</div><!--list-->
										</div><!--sub-menu-->
									</div><!--item-->
									<div class="item  hasChild   ">
										<a href="/.html" id="cat39"> <img src="<?php echo get_template_directory_uri();?>/assets/images/quat-dieu-hoa-thong-minh.jpg" alt="" class="cate-img"><span>Quạt &amp; Quạt điều hòa</span></a>
										<div class="sub-menu  width-1-col ">
											<div class="list">
												<div class="col">
													
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/quat-cay-thong-minh.html">Quạt Cây thông minh</a>
														
														</div>
													</div>
													
													<div class="sub-menu2">
														<div class="item-sub">
														<a href="/quat-dieu-hoa-karofi.html">Quạt điều hòa Karofi</a>
														
														</div>
													</div>
													
												</div>
											</div><!--list-->
										</div><!--sub-menu-->
									</div><!--item-->
								</div>
							</div>
			
						</div>
						<div class="col px-1">
							<div id="nav-right" class="d-flex align-items-center justify-content-between">
							<a href="https://karofivietnam.com.vn/collection/khuyen-mai-soc-trong-thang" class="item"> 
								<div class="pulse-icon"><div class="icon-wrap"></div><div class="elements"><div class="pulse pulse-1"></div></div></div>KHUYẾN MÃI THÁNG <?php echo date('m');?>
							</a>
							<a href="<?php echo get_bloginfo( 'url' );?>/tin-tuc/sua-may-loc-nuoc/" class="item"><i class="fas fa-bolt"></i>SỬA MÁY LỌC NƯỚC</a>
							<a href="<?php echo get_bloginfo( 'url' );?>/tin-tuc/thay-loi-loc-nuoc/" class="item"><i class="fas fa-fire"></i>THAY LÕI LỌC NƯỚC</a>
							<a href="<?php echo get_bloginfo( 'url' );?>/he-thong-phan-phoi-karofi/" class="item"><i class="fas fa-fire"></i>HỆ THỐNG PHÂN PHỐI</a>
							<a href="<?php echo get_bloginfo( 'url' );?>/tin-tuc" class="item"><i class="fas fa-bolt"></i>TIN TỨC</a>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</header>
