<?php
$terms = get_terms( array(
    'taxonomy' => 'project_type',
    'hide_empty' => false,
));
$queried_object = get_queried_object();

?>
    <div class="project-type-menu">
        <a href="/projects" >
            All Projects
        </a>
        <?php
        foreach ( $terms as $term ) :
            ?>
            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="<?php echo $term->slug == $queried_object->slug ?  ' active' : ''; ?>"><?php echo esc_html( $term->name ); ?></a>
        <?php endforeach; ?>
    </div>
