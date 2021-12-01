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
<div class="wrap-crumbs container my-2 my-md-3"><?php if(function_exists('breadcrumb')){breadcrumb();} ?></div>
<div class="container">
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
			<div class="bg-white">
				<div class="p-2">
					<?php if(function_exists('newsViewMore')){newsViewMore();} ?>				
				</div>				
				<h3 class="title-right font-weight-bold text-uppercase px-2">Sản phẩm nổi bật</h3>
				<?php if(function_exists('featureProduct')){featureProduct();} ?>			
				
			</div>
		</div>
	</div>
</div>
<?php if(function_exists('productViewHome')){productViewHome();} ?>
</div><!-- #site-content -->

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
