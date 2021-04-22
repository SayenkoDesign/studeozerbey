<?php get_header();?>

<div class="contact-page">

    <div class="contact-image-text">

        <div class="contact-page-image">
            <?php $contact_page_image = get_field('contact_page_image');?>
            <img src="<?php echo esc_url($contact_page_image['sizes']['large']);
?>" alt="<?php echo $contact_page_image['alt']; ?>">
        </div>

        <?php
if (have_posts()) {
    while (have_posts()) {
        the_post();?>
                <div class="paragraph-text contact-us-page-content">
                    <?php the_content();?>
                </div>
            <?php }
}
;?>

    </div>

    <div class="contact">
        <div class="contact-information">
<!--             <p class="email-address"><?php esc_html(the_field('email_address', 'options'));?></p> -->
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js" integrity="sha512-Meww2sXqNHxI1+5Dyh/9KAtvI9RZSA4c1K2k5iL02oiPO/RH3Q30L3M1albtqMg50u4gRTYdV4EXOQqXEI336A==" crossorigin="anonymous"></script>

        <style>
            .contact-form.hide {
                display: none;
            }
        </style>


        <?php
        // TODO: check forms exist

        // Set form ID's to A/B test
        $form_ids = [5,4];

        $views = 0;
        if( function_exists( 'ev_get_post_view_count' ) ) { // sayenko plugin to make this a 50/50 test
            $views = ev_get_post_view_count( get_the_ID() );
        } else {
            // Fallback to random number generator, coin flip
            $numbers = range(1, 100);
            shuffle($numbers);
            $first = $numbers[0];
            $views = $first;
        }

        // switch form based on AB test
        if ($views % 2 == 0 ) {
            $form_ids = array_reverse( $form_ids );
        }

        $form_id = $form_ids[0];

        printf( '<!--Views: %s-->', $views );

        printf( '<!--Form ID: %s-->', $form_id );

        $cookie_name = sprintf( 'ab-test-%d', get_the_ID() );

        ?>

        

        <?php
            foreach( $form_ids as $form_id ) {
                printf( '<div class="contact-form hide" id="contact-form-%s">', $form_id );
                echo do_shortcode( sprintf( '[gravityform id="%d" title="false" description="false"]', $form_id ) );
                echo '</div>';
            }
        ?>

        <script>
            (function($) {

                'use strict';

                var formID = <?php echo $form_id;?>;

                var clientFormID = Cookies.get('<?php echo $cookie_name;?>');

                if(clientFormID) {
                    formID = clientFormID;
                } else {
                    Cookies.set('<?php echo $cookie_name;?>', formID, { expires: 1 });
                }

                console.log('Client Form ID: ' + formID);

                $('#contact-form-' + formID).removeClass('hide');

            })(jQuery);
        </script>

        <?php //gravity_form( 2, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = false, $tabindex, $echo = true ); ?>
    </div>

</div>

<?php get_footer();?>