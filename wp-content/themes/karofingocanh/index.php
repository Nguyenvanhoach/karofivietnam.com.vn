<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" role="main">
	<div class="container wrap-banner mb-1 mb-md-3">
		<div class="row justify-content-end">			
			<div class="col-6 px-0 px-md-1 cus-col-6">
        <?php if(function_exists('getSliderBanner')){getSliderBanner();} ?>        
      </div>
			<div class="col-3 cus-col-3 pl-0 d-none d-md-block">
        <div class="news-home mt-2">
          <div class="bg-white">
            <h3 class="text-uppercase m-0 px-2 py-2"><i class="far fa-newspaper"></i> Tin tức nổi bật</h3>
            <?php 
              $catID = 1;
              $tin_tuc = new WP_Query(array(
                'cat' => $catID,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => '3', 
              ));
              if($tin_tuc->have_posts()) {
                echo '<ul class="m-0 list-unstyled">';
                  while ($tin_tuc->have_posts()) { 
                    $tin_tuc->the_post(); 
                    echo '<li class="px-2 py-2"><a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="d-block">' . get_the_title() .'</a></li>';
                  }
                echo '</ul>';
              }
            ?>         
          </div>      
          <?php if(function_exists('sliderMainRight')){sliderMainRight();} ?>
        </div>
      </div>
		</div>
	</div>
  <div class="cate-pro-home d-md-none bg-white d-flex flex-nowrap">
    <?php 
      $taxonomy = 'product_cat';
      $args = array('taxonomy'     => $taxonomy,'hide_empty' => false,'orderby'   => 'date','order' => 'ASC');
      $all_categories = get_categories( $args );
      if ( $all_categories && !is_wp_error( $all_categories ) ) {   
        foreach ($all_categories as $cat) {
          if($cat->category_parent == 0 && $cat->slug != 'san-pham-xa-hang' && $cat->slug != 'khuyen-mai-soc-trong-thang') {
            $category_id = $cat->term_id;  
          echo '<div class="item p-2"><a class="d-block" href="'. get_term_link($cat->slug, 'product_cat') .'" title="'.$cat->name.'"><div class="cate-img p-1 mb-2 d-flex align-items-center justify-content-center"><img loading="lazy" src="'.get_template_directory_uri().'/assets/images/'.$cat->slug.'.jpg" alt="'.$cat->name.'" class="img-fluid d-block mx-auto"></div><span class="d-block text-center">'.$cat->name.'</span></a></div>';
          }
        }
      }
    ?>
  </div>
  <div class="container text-center mb-2 d-none d-md-block">
    <img loading="lazy" src="<?php echo get_template_directory_uri();?>/assets/images/karofi_chinhanh.png" alt="" class="img-fluid d-inline-block">
  </div>
  <div class="product-home">
    <div class="container">
      <div class="bg-white">
        <div class="wrap-title clearfix">
          <h2 class="text-uppercase text-center m-0 font-weight-bold title-parent d-flex align-items-center"><img loading="lazy" class="img-fluid mr-2 mr-lg-3" src="<?php echo get_template_directory_uri();?>/assets/images/christmas-bag.png" alt="">KHUYẾN MÃI CỰC SỐC KHI MUA ONLINE</h2>        
          <div class="list-hortial d-flex justify-content-center align-items-center float-right">
            <ul class="list-inline mb-0 mt-2 mr-2">
              <li class="list-inline-item active"><a class="d-block py-2 px-2" href="<?php echo get_bloginfo( 'url' );?>" title="Nổi bật">Nổi bật</a></li>
              <li class="list-inline-item "><a class="d-block py-2 px-2" href="<?php echo get_bloginfo( 'url' );?>/product-category/may-loc-nuoc-tu-dung/" title="Máy lọc nước tủ đứng">Máy lọc nước tủ đứng</a></li>
              <li class="list-inline-item "><a class="d-block py-2 px-2" href="<?php echo get_bloginfo( 'url' );?>/product-category/may-loc-nuoc-khong-tu-de-gam/" title="Máy lọc nước không tủ để gầm">Máy lọc nước không tủ để gầm</a></li>
              <li class="list-inline-item "><a class="d-block py-2 px-2" href="<?php echo get_bloginfo( 'url' );?>/product-category/may-loc-nuoc-hydrogen-karofi/" title="Máy lọc nước Hydrogen Karofi">Máy lọc nước Hydrogen Karofi</a></li>
              <li class="list-inline-item "><a class="d-block py-2 px-2" href="<?php echo get_bloginfo( 'url' );?>/product-category/cay-nuoc-nong-lanh-karofi/" title="Cây nước nóng lạnh Karofi">Cây nước nóng lạnh Karofi</a></li>
              <li class="list-inline-item mr-2"><a class="d-block py-2 px-2" href="<?php echo get_bloginfo( 'url' );?>/product-category/phu-kien-may-loc-nuoc/loi-loc-nuoc-karofi/" title="Lõi lọc nước Karofi">Lõi lọc nước Karofi</a></li>
            </ul>
          </div>
        </div>
        <div class="product-list clearfix">
          <div class="row mx-0">
            <?php
              $tax_featured[] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
              );
              $args_featured = array( 'post_type' => 'product','posts_per_page' => 20,'ignore_sticky_posts' => 1, 'tax_query' => $tax_featured);
              $getposts = new WP_query( $args_featured);
              global $wp_query; $wp_query->in_the_loop = true;
              while ($getposts->have_posts()) : $getposts->the_post();
                global $post, $product; 
                echo '<div class="col-6 col-sm-4 col-md-3 col-lg-cs-5 prod-num-1 py-3"><div class="item"><a class="d-block img-cat position-relative" href="'.get_the_permalink().'" title="'.get_the_title().'">
                  '.get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'img-fluid', 'loading' => 'lazy') ).'
                    '. apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ).'</a>
                  <a class="d-block" href="'.get_the_permalink().'" title="'.get_the_title().'"><h3 class="title-product-home">'.get_the_title().'</h3></a>
                  <div class="wrap-price">'. $product->get_price_html().'</div>
                  <div class="txt-promo">'.get_ecommerce_excerpt().'</div>
                </div></div>';              
              endwhile; wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
      <div class="text-center"><a href="<?php echo get_bloginfo( 'url' );?>/product-category/san-pham-xa-hang" class="btn-viewmore text-center px-3 py-2 my-3">Xem thêm sản phẩm giá sốc <i class="fa fa-caret-down"></i> </a></div>    
    </div>
    
    <?php 
      echo get_product_cat('15');
      echo get_product_cat('20');
      echo get_product_cat('21');
      echo get_product_cat('22');
      echo get_product_cat('27');
      echo productViewHome(); 
    ?>
  </div>
  <div class="list-news-home mb-3">
    <div class="container">
      <div class="bg-white px-3 pt-3">
        <div class="row">
          <?php
            $catID = 1;
            $cat_child=get_categories(array( 'parent' => $catID )	);
            if(count($cat_child) > 0) {
              echo '<div class="col-md-3 col-lg-2"><div class="nav flex-md-column nav-pills" id="list-news-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link text-center text-uppercase mb-3 active" id="tin-tuc-tab" data-toggle="pill" href="#tin-tuc" role="tab" aria-controls="tin-tuc" aria-selected="true">Tin tức</a>';                            
                foreach ($cat_child as $c) {
                  $catID = $c->cat_ID;
                  echo '<a class="nav-link text-center text-uppercase mb-3" id="'.$c->slug.'-tab" data-toggle="pill" href="#'.$c->slug.'" role="tab" aria-controls="'.$c->slug.'" aria-selected="false">'.$c->cat_name.'</a>';
                }
              echo '</div></div>';

              echo '<div class="col-md-9 col-lg-10">
                <div class="tab-content" id="list-news-tabContent">
                  <div class="tab-pane fade show active" id="tin-tuc" role="tabpanel" aria-labelledby="tin-tuc-tab"><div class="row">';
                    $post_cat_news = new WP_Query(array(
                      'category' => $catID,
                      'post_status' => 'publish',
                      'orderby' => 'date',
                      'order' => 'DESC',
                      'posts_per_page' => '5', 
                    ));
                    if($post_cat_news->have_posts()) {
                      $stt = 1;                      
                      while ($post_cat_news->have_posts()) { 
                        $post_cat_news->the_post(); 
                        if($stt == 1) {	
                          echo '<div class="col-md-7 px-md-0"><a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="position-relative first-news d-block mb-3">';
                          if(has_post_thumbnail()) {
                            echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid','loading' => 'lazy', 'alt' => get_the_title() ));
                          } else {
                            echo '<img src="'.get_template_directory_uri().'/assets/images/no_img.png" alt="'.get_the_title().'" class="img-fluid" loading="lazy">';
                          }	
                          echo '<div class="info p-2 p-lg-3"><div class="title-article text-14 mb-2">' . get_the_title() .'</div><div class="time-article"><i class="fas fa-clock"></i> '.get_the_time('d-m-Y, g:i a').'</div></div></a>
                          </div>'; 
                          echo '<div class="col-md-5">';                         
                        } else {
                          echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="media mb-3"><div class="img-news-small mr-2"><div class="img-inner-small">';
                          if(has_post_thumbnail()) {
                            echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid','loading' => 'lazy', 'alt' => get_the_title() ));
                          } else {
                            echo '<img src="'.get_template_directory_uri().'/assets/images/no_img.png" alt="'.get_the_title().'" class="img-fluid" loading="lazy">';
                          }	
                          echo '</div></div><div class="media-body"><div class="info"><div class="title-article text-14 mb-2">' . get_the_title() .'</div><div class="time-article"><i class="fas fa-clock"></i> '.get_the_time('d-m-Y, g:i a').'</div></div></div></a>';
                        }
                        $stt++;			
                      }
                      echo '</div>';                    
                    }
                  echo '</div></div>';
                  foreach ($cat_child as $childItem) {
                    $catID = $childItem->cat_ID;
                    echo '<div class="tab-pane fade" id="'.$childItem->slug.'" role="tabpanel" aria-labelledby="'.$childItem->slug.'-tab"><div class="row">';
                      $post_cat_child = new WP_Query(array(
                        'category_name' => $childItem->name,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => '5', 
                      ));
                      if($post_cat_child->have_posts()) {
                        $stt = 1;                      
                        while ($post_cat_child->have_posts()) { 
                          $post_cat_child->the_post(); 
                          if($stt == 1) {	
                            echo '<div class="col-md-7 px-md-0"><a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="position-relative first-news d-block mb-3">';
                            if(has_post_thumbnail()) {
                              echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid','loading' => 'lazy', 'alt' => get_the_title() ));
                            } else {
                              echo '<img src="'.get_template_directory_uri().'/assets/images/no_img.png" alt="'.get_the_title().'" class="img-fluid" loading="lazy">';
                            }	
                            echo '<div class="info p-2 p-lg-3"><div class="title-article text-14 mb-2">' . get_the_title() .'</div><div class="time-article"><i class="fas fa-clock"></i> '.get_the_time('d-m-Y, g:i a').'</div></div></a>
                            </div>'; 
                            echo '<div class="col-md-5">';                         
                          } else {
                            echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() .'" class="media mb-3"><div class="img-news-small mr-2"><div class="img-inner-small">';
                            if(has_post_thumbnail()) {
                              echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid','loading' => 'lazy', 'alt' => get_the_title() ));
                            } else {
                              echo '<img src="'.get_template_directory_uri().'/assets/images/no_img.png" alt="'.get_the_title().'" class="img-fluid" loading="lazy">';
                            }	
                            echo '</div></div><div class="media-body"><div class="info"><div class="title-article text-14 mb-2">' . get_the_title() .'</div><div class="time-article"><i class="fas fa-clock"></i> '.get_the_time('d-m-Y, g:i a').'</div></div></div></a>';
                          }
                          $stt++;			
                        }
                        echo '</div>';                    
                      }
                    echo '</div></div>';
                  }
              echo '</div></div>';
            }
          ?>      
        </div>
      </div>
    </div>
  </div>
  <div class="tag-search mb-3">
    <div class="container">
      <ul class="list-inline mb-0 bg-white p-3">
        <li class="list-inline-item mr-3 my-1 title position-relative font-weight-bold">Tìm kiếm nhiều</li>
        <li class="list-inline-item mr-3 my-1 position-relative"><a title="Máy lọc nước Hydrogen Karofi" href="<?php echo get_bloginfo( 'url' );?>/product-category/may-loc-nuoc-hydrogen-karofi/">Máy lọc nước Hydrogen Karofi</a></li>
        <li class="list-inline-item mr-3 my-1 position-relative"><a title="Máy lọc nước thông minh" href="<?php echo get_bloginfo( 'url' );?>/product-category/may-loc-nuoc-thong-minh/">Máy lọc nước thông minh</a></li>
        <li class="list-inline-item mr-3 my-1 position-relative"><a title="Máy lọc nước optimus" href="<?php echo get_bloginfo( 'url' );?>/product-category/may-loc-nuoc-karofi-optimus/">Máy lọc nước optimus</a></li>
        <li class="list-inline-item mr-3 my-1 position-relative"><a title="Máy lọc nước không tủ để gầm" href="<?php echo get_bloginfo( 'url' );?>/product-category/may-loc-nuoc-khong-tu-de-gam/">Máy lọc nước không tủ để gầm</a></li>
        <li class="list-inline-item mr-3 my-1 position-relative"><a title="Máy lọc nước gia đình" href="<?php echo get_bloginfo( 'url' );?>/product-category/may-loc-nuoc-korihome/">Máy lọc nước gia đình</a></li>
        <li class="list-inline-item mr-3 my-1 position-relative"><a title="Cây nước nóng lạnh" href="<?php echo get_bloginfo( 'url' );?>/product-category/cay-nuoc-nong-lanh-karofi/">Cây nước nóng lạnh</a></li>
        <li class="list-inline-item mr-3 my-1 position-relative"><a title="Quạt & quạt điều hòa" href="<?php echo get_bloginfo( 'url' );?>/product-category/quat-quat-dieu-hoa/">Quạt & quạt điều hòa</a></li>
        <li class="list-inline-item mr-3 my-1 position-relative"><a title="Lõi lọc nước" href="<?php echo get_bloginfo( 'url' );?>/product-category/phu-kien-may-loc-nuoc/loi-loc-nuoc-karofi/">Lõi lọc nước</a></li>
      </ul>
    </div>
  </div>
  
</main><!-- #site-content -->

<?php
get_footer();
