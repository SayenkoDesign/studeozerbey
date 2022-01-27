<?php
/**
 * Single Post
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'post' );

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

	<?php
	get_template_part( 'template-parts/addtoany', 'vertical' );
	?>
	

<?php get_footer(); ?>
