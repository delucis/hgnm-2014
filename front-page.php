<?php

get_header();

		echo '<article>';

		// Get home page blurb
		if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php component('edit_button') ?>
				<section id="fp-blurb" <?php post_class('fp-section'); ?>>
					<div class="entry"><?php the_content(); ?></div>
					<p class="social-link"><a href="https://www.facebook.com/pages/Harvard-Group-for-New-Music/130937206919388">Join us on Facebook <span class="icon icon-facebook" aria-hidden="true"></span></a></p>
				</section><!-- #post -->
			<?php endwhile; ?>
		<?php else: ?>
		<?php endif;

		// Get upcoming concerts
		$today = date('Ymd', strtotime('-1 day'));
		$concerts = get_posts(
			array(
				'numberposts' => 1,
				'post_type' => 'concert',
				'meta_key' => 'dtstart',
				'orderby' => 'dtstart',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'dtstart',
            'value'  => $today,
            'compare'  => '>'
					)
				)
			)
		);
		// Get upcoming colloquia
		$colloquia = get_posts(
			array(
				'numberposts' => 3,
				'post_type' => 'colloquium',
				'meta_key' => 'dtstart',
				'orderby' => 'dtstart',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'dtstart',
            'value'  => $today,
            'compare'  => '>'
					)
				)
			)
		);
		// Get upcoming miscellaneous events
		$miscevents = get_posts(
			array(
				'numberposts' => 1,
				'post_type' => 'miscevent',
				'meta_key' => 'dtstart',
				'orderby' => 'dtstart',
				'order' => 'ASC',
				'meta_query' => array(
					'relation' => 'OR',
					array(
						'key' => 'dtstart',
						'value' => $today,
            'compare' => '>'
					),
					array(
						'key' => 'dtend',
						'value' => $today,
						'compare' => '>'
					)
				)
			)
		);

		// Display upcoming events
		if($concerts || $colloquia || $miscevents) : ?>
			<section id="events" class="fp-section clearfix">
				<h2>Events</h2>
				<ul>
					<?php if($concerts) : ?>
						<li class="concerts <?php if(!$colloquia) { echo 'solo'; } ?>">
							<h3>Next Concert</h3>
							<?php foreach($concerts as $concert): ?>
								<div class="vevent clearfix">
									<a href="<?php echo get_permalink($concert->ID) ?>" class="url">
										<?php
										// SET START TIME VARIABLE
										if (get_field('start_time')) {
											$start_time = get_field('start_time', $concert->ID);
										}
										// SET TIMEZONE
										date_default_timezone_set('America/New_York');

										// SET START DATE VARIABLE
										if (!empty($start_time)) {
											$dtstart = DateTime::createFromFormat('d/m/Y G:i', (get_field('dtstart', $concert->ID) . ' ' . $start_time));
										}
										else {
											$dtstart = DateTime::createFromFormat('d/m/Y G:i', (get_field('dtstart', $concert->ID) . ' 20:00'));
										}
										?>
										<h4 class="dtstart"><time class="value-title" datetime="<?php echo $dtstart->format('Y-m-d\TH:i:sO'); ?>" title="<?php echo $dtstart->format('Y-m-d\TH:i:sO'); ?>">
											<?php echo '<span class="month">' . $dtstart->format('M') . '</span> <span class="day">' . $dtstart->format('j'); ?>
										</time></h4>
										<div class="details">
											<?php echo '<p class="summary">' . get_the_title($concert->ID) . '</p>'; ?>
											<p class="location vcard"><?php the_field('location', $concert->ID); ?>
												<span class="fn org">
													<span class="value-title" title="Paine Hall, Harvard University Department of Music">
												</span>
												<span class="adr">
													<span class="street-address">
														<span class="value-title" title="North Yard, Harvard University">
													</span>
													<span class="locality">
														<span class="value-title" title="Cambridge">
													</span>
													<span class="region">
														<span class="value-title" title="MA">
													</span>
													<span class="postal-code">
														<span class="value-title" title="02138">
													</span>
												</span>
												<span class="geo">
												   <span class="latitude">
												      <span class="value-title" title="42.377009" ></span>
												   </span>
												   <span class="longitude">
												      <span class="value-title" title="-71.117042"></span>
												   </span>
												</span>
											</p>
										</div>
									</a>
									<span class="category">
										<span class="value-title" title="Concert"></span>
									</span>
								</div>
							<?php endforeach; ?>
						</li>
					<?php endif; ?>
					<?php if($colloquia) : ?>
						<li class="colloquia <?php if(!$concerts) { echo 'solo'; } ?>">
						<h3>Upcoming Colloquia</h3>
						<?php component('colloquium_list', array(
							"colloquia" => $colloquia,
							"show_map_link" => true
						)) ?>
						</li>
					<?php endif; ?>
					<?php if($miscevents) : ?>
						<li class="miscevents">
							<h3>Other Events</h3>
							<ul>
							<?php foreach($miscevents as $miscevent): ?>
								<li class="vevent clearfix">
									<h4 class="dtstart">
										<?php
										$dtstart = DateTime::createFromFormat('d/m/Y', get_field('dtstart', $miscevent->ID));
										$dtend = DateTime::createFromFormat('d/m/Y', get_field('dtend', $miscevent->ID));
										echo '<time class="value-title" datetime="' . $dtstart->format('Y-m-d\TH:i:sO') . '" title="' . $dtstart->format('Y-m-d\TH:i:sO') . '">';
											if(get_field('dtend', $miscevent->ID)) :
												if ($dtstart->format('n') == $dtend->format('n')) :
													echo $dtstart->format('n/j') . '–' . $dtend->format('j');
												else :
													echo $dtstart->format('n/j') . '–' . $dtend->format('n/j');
												endif; ?>
											<?php else : ?>
												<?php echo $dtstart->format('n/j'); ?>
											<?php endif; ?>
										</time>
									</h4>
									<span class="summary"><a href="<?php echo get_permalink($miscevent->ID); ?>" class="url"><?php echo get_the_title($miscevent->ID); ?></a></span>
								</li>
							<?php endforeach; ?>
							</ul>
						</li>
					<?php endif; ?>
						<li class="more-events-link">
							<a href="<?php echo get_post_type_archive_link('colloquium'); ?>">
								<p>See all upcoming events »</p>
							</a>
						</li>
				</ul>
			</section> <!-- #fp-events -->
		<?php endif;

		// Get composers names, photos and permalinks
		$today = date('Ymd', strtotime('-1 day'));
		$posts = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'member',
			'orderby' => 'title',
			'order' => 'ASC',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'dtend',
					'value' => null
				),
				array(
					'key' => 'dtend',
					'value' => $today,
					'type' => 'numeric',
					'compare' => '>'
				)
			)
		));
		if($posts)
		{
			echo '<section class="composers fp-section"><h2>Composers</h2><ul class="clearfix">';
			foreach($posts as $post) { component('member_photo_link', $post->ID); }
			echo '</ul></section>';
		}

		// Display archive link
		?>
		<section id="fp-archive-link" class="fp-section">
			<a href="<?php echo get_post_type_archive_link('concert'); ?>">
				<h2>Archive</h2>
				<p>Dive into an archive of HGNM’s past events, members, audio and video.</p>
			</a>
		</section>

		</article>

<?php get_footer();

?>
