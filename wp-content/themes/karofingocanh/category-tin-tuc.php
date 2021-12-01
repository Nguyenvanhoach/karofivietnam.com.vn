<?php
	get_header();   
	$catalog = get_category( get_query_var( 'cat' ) );
  $cat_slug = $catalog->slug;
	$catID = $catalog->cat_ID;
?>
	<div class="wrap-crumbs container my-2 my-md-3"><?php if(function_exists('breadcrumb')){breadcrumb();} ?></div>
	<div class="container cat-tin-tuc">
		<div class="row mb-3">
			<div class="col-md-8 col-lg-9">
				<ul class="nav nav-news mb-3 mb-md-5">
					<li class="nav-item pr-2 pr-md-3">
						<a title="Tin tức mới" class="text-uppercase px-0  nav-link <?php if($cat_slug == 'tin-tuc') {echo "active";}?>" href="<?php echo get_term_link($cat_slug, 'category'); ?>">Tin tức mới</a>
					</li>			
					<?php
						$categories=get_categories(	array( 'parent' => $catID )	);
					foreach ($categories as $c) {
						echo '<li class="nav-item px-2 px-md-3"><a class="nav-link text-uppercase px-0" href="'. get_term_link($c->slug, 'category') .'" title="'.$c->cat_name.'">'.$c->cat_name.'</a></li>';
					}
					?>
				</ul>
			<div class="bg-white p-3">
				<?php 
					$tin_tuc = new WP_Query(array(
						'cat' => $catID,
						'post_status' => 'publish',
						'orderby' => 'date',
						'order' => 'DESC',
						'posts_per_page' => '4', 
					));
					if($tin_tuc->have_posts()) {
						$stt = 1;
						echo '<div class="row space-1 mb-4 mb-md-5">';
							while ($tin_tuc->have_posts()) { 
								$tin_tuc->the_post(); 
								if($stt == 1) {									
									echo '<div class="col-12 mb-3"><div class="item-news position-relative overflow-hidden"><a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="d-inline-block w-100 blog-img">';
									if(has_post_thumbnail()) {
										echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid d-block w-100 mx-auto','loading' => 'lazy', 'alt' => get_the_title() ));
									} else {
										echo '<img src="'.get_template_directory_uri().'/assets/images/no_img.png" alt="'.get_the_title().'" class="img-fluid" loading="lazy">';
									}	
									echo '</a><div class="content-des"><a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="d-block text-white font-weight-bold text-16">' . get_the_title() .'</a><time class="text-12 font-italic text-white py-1 d-block">'.get_the_time('d-m-Y, g:i a').'</time></div></div></div>';
								} else {
									echo '<div class="col-6 col-md-4 mb-3"><div class="h-100 item-news position-relative overflow-hidden"><a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="d-inline-block w-100 blog-img">';
									if(has_post_thumbnail()) {
										echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid d-block w-100 mx-auto','loading' => 'lazy', 'alt' => get_the_title() ));
									} else {
										echo '<img src="'.get_template_directory_uri().'/assets/images/no_img.png" alt="'.get_the_title().'" class="img-fluid" loading="lazy">';
									}	
									echo '</a><div class="content-des"><a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="d-block text-white font-weight-bold">' . get_the_title() .'</a><time class="text-12 font-italic text-white py-1 d-block">'.get_the_time('d-m-Y, g:i a').'</time></div></div></div>';
								}
								$stt++;			
							}
						echo '</div>';
					}
				?>
				<?php
					$cat_child=get_categories(array( 'parent' => $catID )	);
					if(count($cat_child) > 0){
						foreach ($cat_child as $c) {
							$catID = $c->cat_ID;
							$post_cat_child = new WP_Query(array(
								'category' => $catID,
								'post_status' => 'publish',
								'orderby' => 'date',
								'order' => 'DESC',
								'posts_per_page' => '6', 
							));
							if($post_cat_child->have_posts()) {
								$stt = 1;
								echo '<div class="row mb-4">';
									echo '<div class="col-12"><h2 class="article-cate-title mb-3 d-flex justify-content-between align-items-center"><a href="'. get_term_link($c->slug, 'category') .'" title="'.$c->cat_name.'" class="text-uppercase font-weight-bold">'.$c->cat_name.'</a><a class="view-all" href="'. get_term_link($c->slug, 'category') .'" title="'.$c->cat_name.'"> Xem tất cả &gt;&gt;</a></h2></div>';
									while ($post_cat_child->have_posts()) { 
										$post_cat_child->the_post(); 
										if($stt == 1) {		
											echo '<div class="col-sm-6 mb-3 mb-md-0"><a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="top-news">';
											if(has_post_thumbnail()) {
												echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid d-block w-100 mx-auto mb-2','loading' => 'lazy', 'alt' => get_the_title() ));
											} else {
												echo '<img src="'.get_template_directory_uri().'/assets/images/no_img.png" alt="'.get_the_title().'" class="img-fluid" loading="lazy">';
											}	
											echo '<h3 class="name text-16 font-weight-bold">' . get_the_title() .'</h3><div>'.trim_text_to_words(get_the_content(), 250).'</div></a></div>';
										} else {
											if($stt == 2) {
													echo '<div class="col-sm-6"><div class="list-news">';
													echo '<div class="item pb-3 border-bottom">
														<a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="font-weight-bold d-block mb-2">' . get_the_title() .'</a>
														<a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="img d-block">';
														if(has_post_thumbnail()) {
															echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid d-block w-100 mx-auto','loading' => 'lazy', 'alt' => get_the_title() ));
														} else {
															echo '<img src="'.get_template_directory_uri().'/assets/images/no_img.png" alt="'.get_the_title().'" class="img-fluid mb-2" loading="lazy">';
														}
														echo '</a><div>'.trim_text_to_words(get_the_content(), 250).'</div>
													</div>';
												} else {
													echo '<div class="item py-2 py-md-3 border-bottom"><a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="name">' . get_the_title() .'</a></div>';
												}
											
										}
										$stt++;			
									}
									echo '</div></div>';
								echo '</div>';
							}
							//echo '<li class="nav-item px-3"><a class="nav-link text-uppercase px-0" href="'. get_term_link($c->slug, 'category') .'" title="'.$c->cat_name.'">'.$c->cat_name.'</a></li>';
						}
					}
				?>
			</div>
			</div>
			<div class="col-md-4 col-lg-3 pl-md-0">
				<div class="bg-white">
					<div class="list-news-view mb-3 p-2">
						<h3 class="title-right font-weight-bold text-uppercase">TIN XEM NHIỀU</h3>
						<div class="list-item">							
							<?php
								$cf = new WP_Query(array('category' => $catID,'post_status' => 'publish','posts_per_page' => 10, 'meta_key' => 'post_views_count', 'orderby'=> 'meta_value_num', 'order' => 'DESC'));
								$stt = 0;
								while ($cf->have_posts()) : $cf->the_post();$n=$stt+1;
									echo '<a title="'. get_the_title() . '" href="'.get_permalink().'" class="item border-top media py-2">
									<span class="no">'. $n .'</span><span class="name media-body pl-2">'. get_the_title() . '</span></a>';
										$stt++;
								endwhile;
                wp_reset_postdata();
              ?>
						</div>
					</div>
					<h3 class="title-right font-weight-bold text-uppercase px-2">Sản phẩm nổi bật</h3>
					<?php if(function_exists('featureProduct')){featureProduct();} ?>	
				</div>
			</div>
		</div>
	</div>
	<?php if(function_exists('productViewHome')){productViewHome();} ?>
		
<?php get_footer();
