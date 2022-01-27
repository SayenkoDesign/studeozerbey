<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php     
    $post_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    
    if( empty( $post_image ) ) {
        $post_image = get_field( 'post_image_fallback', 'option' );
        if( ! empty( $post_image ) ) {
            $post_image = wp_get_attachment_image_src( $post_image, 'large' );
        }   
    }
    
    if( ! empty( $post_image ) ) {
        $post_image = sprintf( 'background-image: url(%s);', $post_image );
    }  
    
    $post_category = '';

    if( $post_term = _s_get_primary_term() ) {
        $post_category = sprintf( '<span class="post-category"><a href="%s">%s</a></span>', 
                                   get_category_link( $post_term ), $post_term->name );
    }
       
    $post_title = sprintf( '<h2><a href="%s">%s</a></h2>', get_permalink(), get_the_title() );
    
    $read_more = sprintf( '<p class="more"><a href="%s" class="read-more fancy-link"><span>%s</span>%s</a></p>', 
                           get_permalink(), __( 'read more', '_s' ),
                           
                           _s_get_icon(
                            [
                            'icon'	=> 'arrow-right',
                            'group'	=> 'theme',
                            'width'	=> '8',
                            'height' => '12',
                            'label'	=> false,
                            ] )
                           
                           ) ;
        
    printf( '<a href="%s" class="post-hero" style="%s"></a>', get_permalink(), $post_image );
                    
    printf( '<header class="entry-header">%s%s%s</header>', $post_category, $post_title, $read_more );

    ?>
    
</article><!-- #post-## -->
