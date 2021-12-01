<?php
	get_header();   
  $big = 999999999;
  if ( get_query_var('paged') ) {
    $paged = get_query_var('paged'); 
  } elseif ( get_query_var('page') ) { 
    $paged = get_query_var('page');
  } else {
    $paged = 1;
  }
	$catalog = get_category( get_query_var( 'cat' ) );
  // $cat = get_query_var( 'cat' );
  $cat_slug = $catalog->slug;
	$catID_now = $catalog->cat_ID;
  $catID = 1;

?>
	<div class="wrap-crumbs container my-2 my-md-3"><?php if(function_exists('breadcrumb')){breadcrumb();} ?></div>
	<div class="container cat-tin-tuc">
		<div class="row mb-3">
			<div class="col-md-8 col-lg-9">
				<ul class="nav nav-news mb-3 mb-md-5">
          <li class="nav-item pr-2 pr-md-3">
            <a title="Tin tức mới" class="text-uppercase px-0  nav-link <?php if($cat_slug == 'tin-tuc') {echo "active";}?>" href="<?php echo get_term_link($catID, 'category'); ?>">Tin tức mới</a>
          </li>			
          <?php
            $categories=get_categories(	array( 'parent' => $catID )	);
          foreach ($categories as $c) {
            $active = '';
            if($c->slug == $cat_slug) {$active = 'active';}
            echo '<li class="nav-item px-2 px-md-3"><a class="nav-link text-uppercase px-0 '.$active.'" href="'. get_term_link($c->slug, 'category') .'" title="'.$c->cat_name.'">'.$c->cat_name.'</a></li>';
          }
          ?>
        </ul>
        <div class="bg-white p-3">
          <?php 
            $get_post = new WP_Query(array(
              'cat' => $catID_now,
              'post_status' => 'publish',
              'orderby' => 'date',
              'order' => 'DESC',
              'posts_per_page' => '12', 
              'paged'          => $paged, 
            ));
            if($get_post->have_posts()) {
              while ($get_post->have_posts()) { 
                $get_post->the_post(); 
                echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="row color-black">';
                echo '<div class="col-4 pr-0">'. get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid d-block w-100 mx-auto','loading' => 'lazy','alt' => get_the_title() )) .'</div>
                <div class="col-8"><strong class="text-18 mb-2 d-block color-hover">' . get_the_title() .'</strong><div>'.trim_text_to_words(get_the_content(), 250).'</div></div>';
                echo '</a><hr>';
              }
            }            
            echo "<div class='paginations d-flex'>";	
							echo paginate_links( array(
								'base' => str_replace($big, '%#%', esc_url( get_pagenum_link($big ) ) ),
								'format' => '?paged=%#%',
								'prev_text'    => __('<span class="">prev</span>'),
								'next_text'    => __('<span class="">next</span>'),
								'current' => max( 1, get_query_var('paged') ),
								'total' => $get_post->max_num_pages, //12 là post page $postNo /12
								) );
						    
						echo "</div>";
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
