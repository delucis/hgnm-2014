<?php

get_header();

		if ( have_posts() ) {
			echo '<div id="posts">';

			/* Start the Loop */
			while ( have_posts() ) {
				the_post();

					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
				echo 'Colloquium';

			}
			
			echo '</div>';
		}


get_footer();

?>