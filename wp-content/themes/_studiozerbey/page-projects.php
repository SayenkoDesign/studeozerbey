<?php get_header();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>
        <span class="paragraph-text projects-page-content">
        <?php the_content(); ?>
        </span>
    <?php }
};
$terms = get_terms( array(
    'taxonomy' => 'project_type',
    'hide_empty' => false,
)); ?>

<div class="project-type-menu">
    <a href="<?php site_url( '/projects/')?>" class="active">
        All Projects
    </a>
    <?php
    foreach ( $terms as $term ) { ?>
        <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="<?php echo $term->term_id == $initial_term_id ? ' active' : ''; ?>">
            <?php echo esc_html( $term->name ); ?>
        </a>
    <?php } ?>
</div>

<?php
$args = array(
    'post_type' => 'project',
);

$projects = new WP_Query($args);
if ( $projects->have_posts() ) { ?>
    <div class="project-preview-page-wrapper">
    <?php while ( $projects->have_posts() ) {
        $projects->the_post();
        get_template_part('partials/project_preview_box');
    } ?>
    </div>
<?php }
wp_reset_postdata();
?>

<?php get_footer(); ?>
