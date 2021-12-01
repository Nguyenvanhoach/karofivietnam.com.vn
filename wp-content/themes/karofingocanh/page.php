<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); 
?>
<div class="wrap-crumbs container my-2 my-md-3"><?php if(function_exists('breadcrumb')){breadcrumb();} ?></div>
<div class="container mb-4">
	<div class="row justify-content-center">
		<div class="col-xl-12">
			<div class="content-page bg-white p-3 p-lg-4">
				<h2 class="text-uppercase page-title text-20 mb-3"><?php echo the_title(); ?></h2>
				<?php if ( have_posts() ) : 
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/page/content', 'page' );
						// If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;
					endwhile; // End of the loop.			
				endif; ?>	
			</div>
		</div>
	</div>
</div>

<?php get_footer();
