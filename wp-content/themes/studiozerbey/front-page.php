<?php get_header(); ?>

<section class="slider-about-section">
    <div class="homepage-project-slider">
        <div class="slick-carousel">
            <?php

            $posts = get_field('projects_carousel');
            $featured_project_button_text = esc_html( get_field('project_carousel_button_text') );

            if( $posts ): ?>
                <?php foreach( $posts as $post): ?>
                    <div class="homepage-individual-project">
                        <?php setup_postdata($post); ?>
                        <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( $size = 'large' ); ?>
                        </a>
                        <div class="featured-project-banner">
                            <a class="zerbey-button" href="<?php the_permalink(); ?>"><span><?php echo $featured_project_button_text ?></span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            <h3 class="featured-project-title"><?php the_title(); ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="homepage-about-zerbey">
        <div class="about-text">
            <?php the_field("main_content_text"); ?>
            <a class="zerbey-button-lightgrey-border" href="<?php echo esc_url( site_url( '/services' ) ); ?>"><span><?php esc_html( the_field ("main_content_button_label") ); ?></span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        </div>
        <div class="about-blurbs">
            <?php if( have_rows('homepage_about_section') ): ?>

                <?php while( have_rows('homepage_about_section') ): the_row();

                    $about_image = get_sub_field('homepage_about_image')['sizes']['large'];
                    $about_title = get_sub_field('homepage_about_title');
                    $about_button_text = get_sub_field('homepage_about_button_text');
                    $about_button_link = get_sub_field( "homepage_about_button_link" );
                    $with_lightbox = get_sub_field( "open_in_lightbox" );
                    $lightbox_content = get_sub_field( "lightbox_content" );

                    ?>
                    <div class="blurb">
                        <img src="<?php echo esc_url( $about_image ); ?>" alt="">
                        <div class="text-button">
                            <h2><?php echo esc_html( $about_title ); ?></h2>
                            <a class="zerbey-button-lightgrey-border" <?php echo $with_lightbox ? "data-lity " : null; ?> href="<?php echo esc_url( $about_button_link ); ?>"><span><?php echo esc_html( $about_button_text ); ?></span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                <?php 
                if ($with_lightbox) : ?>
                    <div id="inline" style="background:#fff" class="lity-hide"> <?php echo $lightbox_content; ?></div>
                <?php endif;
            endwhile; ?>

            <?php endif; ?>
        </div>
    </div>
</section>

<section class="testimonials-and-project-types">
    <div class="homepage-testimonials-carousel">
        <?php

        $posts = get_field('testimonials_carousel');

        if( $posts ): ?>
            <h2 class="testimonial-section-title"><?php esc_html( the_field('testimonials_section_title') ); ?></h2>
            <div class="homepage-testimonials slick-carousel">
                <?php foreach( $posts as $post): ?>
                    <?php setup_postdata($post); ?>
                    <div class="individual-testimonial">
                        <span class="testimonial-text">"<?php esc_html( the_field( "testimonial_text" ) ); ?>"</span>
                        <div class="testimonial-author-information">
                            <span class="author">- <?php esc_html( the_field( "testimonial_author" ) ); ?> | </span>
                            <span class="location"><?php esc_html( the_field( "client_location" ) ); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>

    <div class="homepage-project-types">
        <div class="project-types">
            <?php $project_types = get_terms( array(
                'taxonomy' => 'project_type',
                'hide_empty' => false,
            ) );

            foreach ($project_types as $project_type) {
                $project_type_image = get_field('project_type_image', 'project_type' . '_' . $project_type->term_id);
                $project_type_name = $project_type->name; ?>
                <a href="<?php echo site_url('/projects' . '/' . $project_type->slug); ?>">
                    <div class="individual-project-type">
                        <div class="project-title-banner">
                            <h3 class="project-type-name"><?php echo $project_type_name ?></h3>
                        </div>
                        <img src="<?php echo esc_url( $project_type_image['sizes']['large'] ); ?>" alt="<?php
                        $project_type_image['alt'] ?>">
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</section>

<?php
if( have_rows('logos') ) :
?>
<section class="home-logos">
    <?php
    $logos = '';
    while ( have_rows('logos') ) :
        the_row();
        $image = wp_get_attachment_image( get_sub_field( 'image' ), 'medium' );
        $url = get_sub_field( 'url' );
        if( $url ) {
            $logos .= sprintf( '<li><a href="%s">%s</a></li>', $url, $image );
        } else {
            $logos .= sprintf( '<li><span>%s</span></li>', $image );
        }
    endwhile;
    
    if( ! empty( $logos ) ) {
        printf( '<ul>%s</ul>', $logos );
    }
    ?>
</section>
<?php
endif;
?>

<?php
if( shortcode_exists( 'instagram-feed' ) ) {
    echo do_shortcode( '[instagram-feed]' );

    $photos = [ 'sbi_17862804038475384', 'sbi_17880659212788483', 'sbi_18129642667025190', 'sbi_17885119105440915', 'sbi_18108649759010071'];

    echo '<style>';
    echo '#sb_instagram { margin: 60px auto; }';
    
    foreach( $photos as $photo ) {
        printf( '#%s .sbi_photo {
            background-size: auto!important;
        }', $photo );
    }
    
    echo '</style>';
}

?>

<?php get_footer(); ?>

