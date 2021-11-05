<?php
/**
 * Template part for displaying posts with excerpts
 *
 * Used in Search Results and for Recent Posts in Front Page panels.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-summary">
		<div class="media">
			<?php 
			if ( has_post_thumbnail() ) { 
				echo '<div class="img-search d-none d-md-block mr-2 mr-sm-3 mr-md-4 position-relative">'. get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'img-fluid')) .'</div>';
			} 
      echo '<div class="media-body">';
        if ( 'post' === get_post_type() ) {
					echo '<div class="entry-meta mb-2">';
						// echo twentyseventeen_time_link();
						// twentyseventeen_edit_link();
					echo'</div>';
				}	elseif ( 'page' === get_post_type() && get_edit_post_link() ) {
					echo '<div class="entry-meta mb-2">';
						// fv
					echo '</div>';
				}			
				echo the_title( sprintf( '<h2 class="entry-title mt-0 pt-0"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				if ( has_post_thumbnail() ) {
					echo '<div class="d-block d-md-none mb-2">';
						echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'img-fluid mx-auto'));       				
					echo '</div>';
				}
				the_excerpt();
			echo '</div>';
      ?>
		</div>  	
	</div><!-- .entry-summary -->
</article><!-- #post-## -->



