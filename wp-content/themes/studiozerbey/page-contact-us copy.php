<?php get_header(); ?>

<div class="contact-page">

    <div class="contact-image-text">

        <div class="contact-page-image">
            <?php $contact_page_image = get_field('contact_page_image'); ?>
            <img src="<?php echo esc_url($contact_page_image['sizes']['large']);
            ?>" alt="<?php echo $contact_page_image['alt']; ?>">
        </div>

        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); ?>
                <div class="paragraph-text contact-us-page-content">
                    <?php the_content(); ?>
                </div>
            <?php }
        }; ?>

    </div>

    <div class="contact">
        <div class="contact-information">
<!--             <p class="email-address"><?php esc_html( the_field( 'email_address' , 'options') ); ?></p> -->
        </div>
        <div class="contact-form">
        
            <?php            
                if( shortcode_exists( 'gravity_form_ab' ) ) {
                    echo do_shortcode( '[gravity_form_ab ids="2,4"]' );
                } else {
                    echo do_shortcode( '[gravityform id="2" title="false" description="false"]' );
                }
            ?>

            <?php //gravity_form( 2, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = false, $tabindex, $echo = true ); ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>