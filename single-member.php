<?php

get_header();

		if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post" <?php post_class(); ?>>
					<h2 class="post-title"><?php the_title(); ?></h2>
					<div class="entry"><?php the_content(); ?></div>
					<?php if( get_field('url') ): ?>
						<a href="<?php the_field('url'); ?>">Personal Website</a>
					<?php endif; ?>
				</article><!-- #post -->
			<?php endwhile; ?>
		<?php else: ?>
		<?php endif;

get_footer();

?>