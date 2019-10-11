<?php get_header();?>

<div class="individual-project-page-wrapper">
    <?php
        $terms = get_terms( array(
            'taxonomy' => 'project_type',
            'hide_empty' => false,
        ));
        $queried_object = get_queried_object();
        $images = get_field( 'project_gallery' );
    ?>
    <div class="project-type-menu">
        <a href="/projects" >
            All Projects
        </a>
        <?php
        foreach ( $terms as $term ) :
            ?>
            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="<?php echo get_terms()[0]->slug == $term->slug ?  ' active' : ''; ?>"><?php echo esc_html( $term->name ); ?></a>
        <?php endforeach; ?>
    </div>

    <div class="two-columns">
        <div class="left-column">
            <div class="individual-project-text">
                <h1 class="individual-project-title"><?php the_title(); ?></h1>
                <!-- AddToAny BEGIN -->
                <div class="a2a_kit a2a_default_style">
                <a class="a2a_button_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a class="a2a_button_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a class="a2a_button_linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                <a class="a2a_button_pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a class="a2a_button_email"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->
                <?php
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        the_content();
                    }
                } ?>
            </div>
            
            <button type="button" class="button btn contact-trigger spu-open-977">Contact Us</button>
            
        </div>
        
        <div class="right-column">
        
	        <?php if( $images ): ?>
	            <div class="single-project-gallery" id="big-image">
	                <?php foreach( $images as $image ): ?>
	                    <img
	                        srcset="
	                            <?php echo esc_url( $image['sizes']['project-mobile'] ); ?> 480w,
	                            <?php echo esc_url( $image['sizes']['large'] ); ?> 1024w,
	                            <?php echo esc_url( $image['sizes']['project-fullwidth'] ); ?> 1440w
	                        "
	                        sizes="
	                            (max-width: 480px) 480px,
	                            (max-width: 1024px) 1024px,
	                            1440px
	                        "
	                        src="<?php echo esc_url( $image['sizes']['project-fullwidth'] ); ?>"
	                        alt="<?php echo $image['alt']; ?>"
	                    />
	                <?php endforeach; ?>
	            </div>
	        <?php endif; ?>
	        
	        <div class="thumbnails-gallery">
                <?php foreach( $images as $image ): $i++; ?>
                    <a href="#" data-slide="<?php echo $i; ?>" class="thumbnail">
                        <img  src="<?php echo esc_url( $image['sizes']['project-gallery-thumb'] ); ?>"
                            alt="<?php echo $image['alt']; ?>"
                        />
                    </a>
                <?php 
              
                endforeach; 
                ?>
            </div>
        
        </div>
        
    </div>
</div>

<?php get_footer(); ?>