<?php
	
  add_action( 'pre_get_posts', function( $query ) {

	if ( $query->is_main_query() && ! is_admin() && is_tax( 'project_type' ) ) {
		$query->set( 'posts_per_page', '100' );
	}
  } );