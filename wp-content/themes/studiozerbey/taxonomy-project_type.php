<?php get_header();
get_template_part('partials/project_type_menu'); ?>


<?php

if ( have_posts() ) : ?>
    <div class="project-preview-page-wrapper">
    <?php while ( have_posts() ) : the_post();
        get_template_part('partials/project_preview_box');
    endwhile; ?>
    </div>
<?php endif;
?>

<?php get_footer(); ?>
