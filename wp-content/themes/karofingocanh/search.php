<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
	<div class="container">
		<div class="wrap page-search p-3 p-lg-5 bg-white">
			<?php
			if ( have_posts() ) : 
				echo '<h3 class="entry-title border-bottom pb-2">';
				printf( __( 'Kết quả tiềm kiếm: %s', 'twentyseventeen' ), '<span class="text-capitalize" style="color:#00aef0">' . get_search_query() . '</span>' );
				echo '</h3>';
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content', 'search' );

				endwhile; // End of the loop.

				the_posts_pagination( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Trang Trước', 'twentyseventeen' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Trang Tiếp', 'twentyseventeen' ) . '</span>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Trang', 'twentyseventeen' ) . ' </span>',
				) );

			else : ?>

				<p class="mb-4"><?php _e( 'Xin lỗi, nhưng không có gì phù hợp với cụm từ tìm kiếm của bạn. Vui lòng thử lại với một số từ khóa khác nhau.', 'twentyseventeen' ); ?></p>
				<?php
					get_search_form();

			endif;
			?>
		</div>
	</div><!-- .wrap -->

<?php get_footer();
