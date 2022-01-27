<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<header class="archive-header">
			<?php
			$secondary_title = '';

			if( is_category() ) {
				$secondary_title = sprintf( '<span>/%s</span>', single_cat_title( '', false ) );
			}

			if( is_tag() ) {
				$secondary_title = '/' . sprintf( '<span>/%s</span>', single_tag_title( '', false ) );
			}
			?>
			<h1 class="page-title"><?php echo get_the_title( get_option('page_for_posts', true) ) . $secondary_title; ?></h1>
			
			<div class="nav-bar">
			<div class="btn">
				<span class="label">Select Category</span>
				<span class="open"></span>
				<span class="close"></span>
			</div>
			<?php
			wp_nav_menu( [ 'container' => '', 'theme_location' => 'resources' ] );
			?>
			</div>

			<?php
			wp_nav_menu( array(
				'theme_location' => 'resources',
				'walker'         => new Walker_Nav_Menu_Dropdown(),
				'items_wrap'     => '<div class="mobile-resources-menu"><h3>Select Category</h3><form><select onchange="if (this.value) window.location.href=this.value">%3$s</select></form></div>',
			) );	
			?>

		</header>

		<?php if ( have_posts() ) : ?>

			<div class="posts-grid">
			
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'post-column' );

			// End the loop.
			endwhile;

			?>
			</div>
			<?php

			if( function_exists( '_s_paginate_links' ) ) {
				
				$arrow_left = _s_get_icon(
					[
					'icon'	=> 'arrow-left',
					'group'	=> 'theme',
					'width'	=> '8',
					'height' => '12',
					'label'	=> false,
					] );
			
				$arrow_right = _s_get_icon(
						[
						'icon'	=> 'arrow-right',
						'group'	=> 'theme',
						'width'	=> '8',
						'height' => '12',
						'label'	=> false,
						] );
				
				echo _s_paginate_links(
					[
						'prev_text'          => sprintf( '%s<span class="screen-reader-text">%s</span>', 
														  $arrow_left, __('Previous', '_s') ),
						'next_text'          => sprintf( '<span class="screen-reader-text">%s</span>%s', 
														  __('Next', '_s'), $arrow_right ),
					]
				);
			} else {
				echo paginate_links();   
			}
			?>
			
			<?php

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
