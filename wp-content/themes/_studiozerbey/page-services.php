<?php get_header(); ?>

<div class="services-page-wrapper">
    <div class="image">
        <?php $services_page_image = get_field('services_image'); ?>
        <img src="<?php echo esc_url($services_page_image['sizes']['large']);
        ?>" alt="<?php echo $services_page_image['alt']; ?>">
    </div>
    <div class="text">
        <h1><?php the_title(); ?></h1>
        <div class="services-text">
            <?php if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    the_content();
                }
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
