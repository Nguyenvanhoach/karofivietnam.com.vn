<div class="entry-content">		
	<?php
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
			'after'  => '</div>',
		) );
	?>
</div><!-- .entry-content -->

