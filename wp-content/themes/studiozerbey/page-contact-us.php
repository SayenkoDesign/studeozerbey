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
            <h3 class="phone-number">Ph: <p><?php esc_html( the_field( 'telephone_number' , 'options') ); ?></p></h3>
            <p class="email-address"><?php esc_html( the_field( 'email_address' , 'options') ); ?></p>
        </div>
        <div class="contact-form">

            <?php gravity_form( 1, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = false, $tabindex, $echo = true ); ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>