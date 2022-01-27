<?php

class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = NULL ){
		$indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
	}

	function end_lvl(&$output, $depth = 0, $args = NULL ){
		$indent = str_repeat("\t", $depth); // don't output children closing tag
	}

	/**
	* Start the element output.
	*
	* @param  string $output Passed by reference. Used to append additional content.
	* @param  object $item   Menu item data object.
	* @param  int $depth     Depth of menu item. May be used for padding.
	* @param  array $args    Additional strings.
	* @return void
	*/
	function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0) {
 		$url = '#' !== $item->url ? $item->url : '';
        $item->title = str_repeat("-", $depth * 2) . $item->title;
 		$output .= '<option value="' . $url . '">' . $item->title;
	}	

	function end_el(&$output, $item, $depth = 0, $args = NULL){
		$output .= "</option>\n"; // replace closing </li> with the option tag
	}
}


function add_custom_class($classes=array(), $menu_item=false) {
    if ( !is_page() && $menu_item->object_id == get_option( 'page_for_posts' ) &&
            !in_array( 'current-menu-item', $classes ) ) {
        $classes[] = 'current-menu-item';        
    }                    
    return $classes;
}
add_filter('nav_menu_css_class', 'add_custom_class', 100, 2); 


// Custom paginate links function
function _s_paginate_links( $args = [] ) {
    
    $defaults = array(
        'prev_text'          => __('<span>« Previous Page</span>', '_s'),
        'next_text'          => __('<span>Next Page »</span>', '_s'),
        'type'               => 'array'
    );
    
    $args = wp_parse_args( $args, $defaults );
    
    $links =  paginate_links( $args );
    
    if( empty( $links ) ) {
        return false;
    }
    
    $out = [];
    
    $previous = $next = false;
    
    foreach( $links as $link ) {
        $class = 'number';
        if (strpos( $link, 'prev') !== false) {
            $previous = true;
            $class = 'nav-previous';
        } else if (strpos( $link, 'next') !== false) {
            $next = true;
            $class = 'nav-next';
        } else {
            $class = 'number';   
        }
        
        $out[] = sprintf( '<li class="%s">%s</li>', $class, $link );
    }
    
    if( ! $previous ) {
        array_unshift( $out, sprintf( '<li class="nav-previous"><a class="disable">%s</a></li>', $args['prev_text'] ) );
    }
    
    if( ! $next ) {
        $out[] = sprintf( '<li class="nav-next"><a class="disable">%s</a></li>', $args['next_text'] );
    }
    
    return sprintf( '<div class="posts-pagination"><ul class="nav-links">%s</ul>', join( '', $out ) );
}


// Custom post navigation function
function _s_get_the_post_navigation( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'prev_text'          => '%title',
        'next_text'          => '%title',
        'in_same_term'       => false,
        'excluded_terms'     => '',
        'taxonomy'           => 'category',
        'screen_reader_text' => __( 'Post navigation', '_s' ),
        'type' => 'html'
    ) );
 
    $navigation = '';
 
    $next = get_previous_post_link(
        '<div class="nav-next">%link</div>',
        $args['next_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );
 
    $previous = get_next_post_link(
        '<div class="nav-previous">%link</div>',
        $args['prev_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );
 
    // Only add markup if there's somewhere to navigate to.
    if ( $previous || $next ) {
        
        if( 'array' == $args['type'] ) {
            $navigation = [ 'previous' => $previous, 'next' => $next ];
        } else {
           $navigation = _navigation_markup( $previous . $next, 'post-navigation', $args['screen_reader_text'] ); 
        }        
    }
 
    return $navigation;
}


function _s_get_post_terms( $args = array() ) {
    
    $defaults = array(
         'taxonomy' => 'category',
         'post_id' => get_the_ID(),
         'return' => 'string', // string or array
         'class' => 'post-terms',
         'link' => true,
         'svg' => true
    );
    
    $args = wp_parse_args( $args, $defaults );
    
    $post_id = $args['post_id'];
    $taxonomy = $args['taxonomy'];
    $terms = wp_get_post_terms( $post_id, $taxonomy );
    if( !is_wp_error( $terms ) && !empty( $terms ) ) {
        $out = [];
        foreach( $terms as $term ) {
            $term_class = sanitize_title( $term->name );
            
            if( true == $args['link'] ) {
                $link_open = sprintf( '<a href="%s" class="term-link %s">', get_term_link( $term->slug, $taxonomy ), $term_class );
                $link_close = '</a>';
            } else {
                $link_open = $link_close = '';
            }
            
            if( true == $args['svg'] ) {
                $svg = get_svg( $term_class );
            } else {
                $svg = '';   
            }
            
            $out[] = sprintf( '%s%s<span>%s</span>%s', 
                               $link_open, 
                               $svg,
                               $term->name,
                               $link_close
                            );
        }
        
        if( 'array' == $args['return'] ) {
            return $out;
        }
        
        return ul( $out, [ 'class' => $args['class'] ] );
        
    }
    
}


/**
 * Get the primary term of a post, by taxonomy.
 * If Yoast Primary Term is used, return it,
 * otherwise fallback to the first term.
 *
 * @version  1.1.0
 *
 * @link     https://gist.github.com/JiveDig/5d1518f370b1605ae9c753f564b20b7f
 * @link     https://gist.github.com/jawinn/1b44bf4e62e114dc341cd7d7cd8dce4c
 * @author   Mike Hemberger @JiveDig.
 *
 * @param    string  $taxonomy  The taxonomy to get the primary term from.
 * @param    int     $post_id   The post ID to check.
 *
 * @return   WP_Term|bool  The term object or false if no terms.
 */
function _s_get_primary_term( $taxonomy = 'category', $post_id = false ) {
	// Bail if no taxonomy.
	if ( ! $taxonomy ) {
		return false;
	}
	// If no post ID, set it.
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	// If checking for WPSEO.
	if ( class_exists( 'WPSEO_Primary_Term' ) ) {
		// Get the primary term.
		$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
		// If we have one, return it.
		if ( $wpseo_primary_term ) {
			return get_term( $wpseo_primary_term );
		}
	}
	// We don't have a primary, so let's get all the terms.
	$terms = get_the_terms( $post_id, $taxonomy );
    
	// Bail if no terms.
	if ( ! $terms || is_wp_error( $terms ) ) {
		return false;
	}
    
	// Return the first term.
	return $terms[0];
}


function _s_get_post_term( $post_id ) {
    $taxonomy = 'category';
    $terms = wp_get_post_terms( $post_id, $taxonomy );
    if( !is_wp_error( $terms ) ) {
        $term = array_pop($terms);
        $term_class = sanitize_title( $term->name );
        return sprintf( '<a href="%s" class="term-link %s">%s<span>%s</span></a>', get_term_link( $term->slug, $taxonomy ), $term_class, get_svg( $term_class ), $term->name );
    }
    
}

// Switch comment form submit to a button, for better styling
function comment_form_submit_button($button) {
    $button = sprintf( "<button class='submit button'><span>%s</span></button>", 'Post Comment' ) . //Add your html codes here
    get_comment_id_fields();
    return $button;
}
add_filter('comment_form_submit_button', 'comment_form_submit_button');




/**
 * READING TIME
 *
 * Calculate an approximate reading-time for a post.
 *
 * @param  string $content The content to be measured.
 * @return  integer Reading-time in seconds.
 */
function reading_time( $content ) {

	// Predefined words-per-minute rate.
	$words_per_minute = 225;
	$words_per_second = $words_per_minute / 60;

	// Count the words in the content.
	$word_count = str_word_count( strip_tags( $content ) );

	// [UNUSED] How many minutes?
	$minutes = floor( $word_count / $words_per_minute );

	// [UNUSED] How many seconds (remainder)?
	$seconds_remainder = floor( $word_count % $words_per_minute / $words_per_second );

	// How many seconds (total)?
	$seconds_total = floor( $word_count / $words_per_second );

	return $seconds_total;
}

function secondsToTime( $inputSeconds ) {
    
    if( $inputSeconds < 60 ) {
        return sprintf( '1 min', $inputSeconds );
    }
    
    $secondsInAMinute = 60;
    $secondsInAnHour = 60 * $secondsInAMinute;
    $secondsInADay = 24 * $secondsInAnHour;

    // Extract days
    $days = floor($inputSeconds / $secondsInADay);

    // Extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // Extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // Extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // Format and return
    $timeParts = [];
    $sections = [
        'day' => (int)$days,
        'hour' => (int)$hours,
        'minute' => (int)$minutes
    ];

    foreach ($sections as $name => $value){
        if ($value > 0){
            $timeParts[] = $value. ' '.$name.($value == 1 ? '' : 's');
        }
    }

    return implode(', ', $timeParts);
}

/**
 * PARSE TIME
 *
 * Convert seconds (int) into a nicely formatted string.
 *
 * @param  integer $seconds The number of seconds.
 * @return  string Formatted output.
 */
function parse_read_time( $seconds ) {
	
	// String to store our output.
	$string_output = '';

	// Double-check we're using an integer.
	$seconds = (int) $seconds;

	// How many minutes?
	$minute_count = floor( $seconds / 60 );
	$minute_count = convert_number_to_words( $minute_count );

	// How many seconds?
	$minute_remainder = $seconds % 60;

	/**
	 * Specific responses for a range
	 * of times up to two minutes:
	 */
	if ( $seconds < 30 ) {

		$string_output .= 'hardly any time at all.';

	} elseif  ( $seconds < 50 ) {
		
		$string_output .= 'less than a minute.';

	} elseif  ( $seconds < 55 ) {
		
		$string_output .= 'nearly a minute.';

	} elseif  ( $seconds < 65 ) {
		
		$string_output .= 'one minute dead.';

	} elseif  ( $seconds < 85 ) {
		
		$string_output .= 'a minute and a bit.';

	} elseif  ( $seconds < 95 ) {
		
		$string_output .= 'roughly a minute and a half.';

	} elseif  ( $seconds < 120 ) {
		
		$string_output .= 'less than two minutes.';

	/**
	 * Dynamic responses for a variety
	 * of times over two minutes:
	 */
	} elseif ( $minute_remainder < 2 || $minute_remainder > 58 ) {

		// If we're within +/- 2 seconds of a minute:
		$string_output .= $minute_count . ' minutes';

	} elseif ( $minute_remainder > 50 ) {

		// If we're within less than 10 seconds short of any minute:
		$string_output .= 'just shy of ' . $minute_count . ' minutes.';

	} elseif ( $minute_remainder < 10 ) {

		// If we're within less than 10 seconds over any minute:
		$string_output .= 'a little over ' . $minute_count . ' minutes.';

	} elseif ( $minute_remainder < 15 || $minute_remainder > 45 ) {

		// If we're within +/- 15 seconds of any minute:
		$string_output .= 'about ' . $minute_count . ' minutes.';

	} elseif ( $minute_remainder > 20 && $minute_remainder < 40 ) {

		// If we're within +/- 10 seconds of any half-minute:
		$string_output .= $minute_count . ' and a half minutes.';

	} elseif ( $minute_remainder < 10 || $minute_remainder > 50 ) {
		$string_output .= $minute_count . ' minutes (ish).';
	} else {
		$string_output .= 'something like ' . $minute_count . ' minutes.';
	}

	return $string_output;
}

/**
 * DISPLAY NUMBERS
 * 
 * Convert numbers into human-readable words.
 *
 * Borrowed from:
 * http://www.karlrixon.co.uk/writing/convert-numbers-to-words-with-php/
 *
 * @param  integer $number Raw number.
 * @return string         Number as a word.
 */
function convert_number_to_words($number) {
    
    $dictionary  = array(
        0   => 'zero',
        1   => 'one',
        2   => 'two',
        3   => 'three',
        4   => 'four',
        5   => 'five',
        6   => 'six',
        7   => 'seven',
        8   => 'eight',
        9   => 'nine',
        10  => 'ten',
        11  => 'eleven',
        12  => 'twelve',
        13  => 'thirteen',
        14  => 'fourteen',
        15  => 'fifteen',
        16  => 'sixteen',
        17  => 'seventeen',
        18  => 'eighteen',
        19  => 'nineteen',
        20  => 'twenty',
        30  => 'thirty',
        40  => 'fourty',
        50  => 'fifty',
        60  => 'sixty',
        70  => 'seventy',
        80  => 'eighty',
        90  => 'ninety',
        100 => 'hundred'
    );

    $string = $dictionary[$number];

    return $string;
}

if ( ! function_exists( '_s_get_posted_on' ) ) :

    function _s_posted_on( $format = '' ) {
        echo   _s_get_posted_on( $format ); 
    }

endif;


/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _s
 */

if ( ! function_exists( '_s_get_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function _s_get_posted_on( $format = '' ) {
	
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( $format ) )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', '_s' ),
		$time_string
	);

	return '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;