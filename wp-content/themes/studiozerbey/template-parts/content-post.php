<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */
?>


<article id="post-<?php the_ID();?>" <?php post_class();?>>

        <header class="entry-header">
        <?php

        global $post;
        $read = reading_time( $post->post_content );
        if( $read ) {
        
        $read_icon = _s_get_icon(
                [
                'icon'	=> 'read',
                'group'	=> 'theme',
                'width'	=> '24',
                'height' => '24',
                'class'	=> 'read-time',
                'label'	=> false,
                ]
        );
        
        printf( '<div class="read">%s<span> %s Read</span></div>', $read_icon, secondsToTime( $read )  );
        }

        the_title('<h1 class="entry-title">', '</h1>');

        get_template_part( 'template-parts/author' );
        

        get_template_part( 'template-parts/addtoany' );
        ?>
        </header><!-- .entry-header -->


    <div class="entry-content">
        <?php
        // the_post_thumbnail( 'large' );

        the_content();
        ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
        <?php

        $date_format = get_option( 'date_format' );
        printf( '<p class="entry-meta">Posted on: %s</p>', _s_get_posted_on( $date_format ) );


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

        $previous = sprintf('%s<span>%s</span>', $arrow_left, __('Previous', '_s') );

        $next = sprintf('<span>%s</span>%s', __('Next', '_s'), $arrow_right );

        echo _s_get_the_post_navigation(array('prev_text' => $previous, 'next_text' => $next));

        
        ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
