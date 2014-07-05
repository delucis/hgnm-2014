<?php

get_header();

		// If there is a year query, e.g. '?y=2012', get it and use it as a variable, else set it to the current year
		if(get_query_var('y')) {
			if (filter_var(get_query_var('y'), FILTER_VALIDATE_INT, array('options' => array ('min_range' => 0, 'max_range' => 9999,))) !== FALSE) {
				$yearquery = get_query_var('y');
			}
		}
		else {
			$yearquery = date('Y');
		}
		
		// Set season date variables
		$seasonstart = $yearquery . '0901';
		$seasonend = ($yearquery + 1) . '0831';
		$season = array($seasonstart,$seasonend);
		
		// Set pretty season range
		// Format 'YYYY–YY' unless turn of century, in which case 'YYYY–YYYY'
		if (($yearquery % 100) == 99) {
			$seasontitle = $yearquery . '–' . ($yearquery + 1);
		}
		else {
			$seasontitle = $yearquery . '–' . (($yearquery + 1) % 100);
		}
		
		// Check queries to see if it is for a season starting more than a year in the future. N.B. The *next* season will return as false.
		if ($seasonstart > date('Ymd', strtotime(date('Ymd', mktime()) . ' + 365 day')) ) {
			// What should happen if someone wants to see into the future?
			echo '<article class="p-section"><h2>Archives</h2><p>Welcome to the future! It looks like you’re looking for events in the ' . $seasontitle . ' season, but unfortunately this is neither a time machine nor a crystal ball. Why not <a href="' . get_post_type_archive_link('concert') . '">check out what’s happening right now</a>?</p></article>';
		}
		elseif ($seasonstart > date('Ymd')) {
			// What should happen if it is the *next* season
			echo 'Coming up next year!';
		}
		elseif ($seasonstart < 19840900) {
			// What should happen if it is before HGNM was founded?
			echo 'Hold your horses, HGNM didn’t even exist then!';
		}
		else {
			// OK, now we’re talking. Check if posts exist?
		}

get_footer();

?>