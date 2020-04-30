<?php get_header(); ?>

<div class="thank-you-page">

    <div class="contact-image-text">

        <div class="thank-you-page-image">
            <?php $contact_page_image = get_field('thank_you_page_image'); ?>
            <img src="<?php echo esc_url($contact_page_image['sizes']['large']);
            ?>" alt="<?php echo $contact_page_image['alt']; ?>">
        </div>

    </div>

    <div class="copy">
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); ?>
                <div class="paragraph-text thank-you-page-content">
                    <?php the_content(); ?>
                    
					<button onclick="goBack()">Go Back</button>
			
					<script>
					function goBack() {
					  window.history.back();
					}
					</script>         
                    
                </div>
            <?php }
        }; ?>
		

    </div>

</div>

<?php get_footer(); ?>