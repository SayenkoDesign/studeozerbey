<?php get_header(); ?>

<div class="about-us-page-wrapper">
    <div class="image-and-about-text">
        <div class="about-us-image">
            <?php
            $about_us_image = get_field('zerbey_team_picture'); ?>
            <img src="<?php echo esc_url($about_us_image['sizes']['large']);
            ?>" alt="<?php echo $about_us_image['alt']; ?>">
        </div>
        <div class="about-us-text">
            <?php if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    the_content();
                }
            }
            ?>
        </div>
    </div>
    <div class="about-testimonials-carousel">
        <?php

        $posts = get_field('testimonials_carousel');

        if( $posts ): ?>
            <h2 class="testimonial-section-title"><?php esc_html( the_field('testimonial_section_title') ); ?></h2>
            <div class="about-page-testimonials slick-carousel">
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
    <div class="team-members-section">

        <?php
        if ( have_rows('zerbey_staff') ) { ?>
            <h2><?php echo esc_html(get_field('zerbey_staff_section_title')); ?></h2>
            <div class="team-list">
                <?php
                while (have_rows('zerbey_staff')) {
                    the_row();
                    $member_image = esc_url(get_sub_field('staff_profile_picture')['sizes']['medium']);
                    $name = esc_html(get_sub_field('name'));
                    $role = esc_html(get_sub_field('role'));
                    $bio = esc_html(get_sub_field('bio'));
                    ?>
                    <div class="team-item">
                        <img src="<?php echo $member_image ?>" alt="<?php echo $name ?>">
                        <div class="meta">
                            <h4>
                                <span class="team-member-name"><?php echo $name ?></span><br/>
                                <span class="title"><?php echo $role ?></span>
                            </h4>
                            <p><?php echo $bio ?></p>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
            <?php
        }
        ?>

    </div>
    <div class="press-section">
        <h2><?php echo esc_html(get_field('press_section_title')); ?></h2>
        <div class="press-list">
            <?php
            if ( have_rows('in_the_press') ) {
                while (have_rows('in_the_press')) {
                    the_row();
                    $default_image = get_template_directory_uri() . '/img/media_link_placeholder.png';
                    $cover_image = esc_url(get_sub_field('press_cover_image')['sizes']['large']);
                    $name = esc_html(get_sub_field('media_name'));
                    $title = esc_html(get_sub_field('article_title'));
                    $link = esc_url(get_sub_field('link'));
                    $pdf = esc_url(get_sub_field('pdf'));
                    ?>
                    <div class="press-item">
                        <a href="<?php echo(!empty($pdf) ? $pdf : $link) ?>" target="_blank">
                            <img src="<?php echo empty( $cover_image ) ? $default_image : $cover_image ?>" alt="Studio Zerbey in the media">
                        </a>
                        <div class="meta">
                            <h4>
                                <span class="media-name"><?php echo $name ?></span><br/>
                                <span class="article-title"><?php echo $title ?></span>
                            </h4>
                        </div>
                    </div>
                <?php
                }
            }
            ?>
        </div>
    </div>


</div>

<?php get_footer(); ?>
