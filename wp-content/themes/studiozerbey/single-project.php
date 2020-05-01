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
                <?php
                // get Title (Headline) value from Yoast SEO post meta
                $yoast_title = get_post_meta( get_the_ID(), '_yoast_wpseo_title', true);
	
                // get Description value from Yoast SEO post meta
                $yoast_description = get_post_meta( get_the_ID(), '_yoast_wpseo_metadesc', true);
                
                $thumbnail = urlencode( get_the_post_thumbnail_url() );
                $permalink = urlencode( get_permalink() );
                // Linkedin
                $title = ! empty( $yoast_title ) ? $yoast_title : get_the_title();
                $summary = $yoast_description;
                // Email
                $subject = sprintf( 'Someone would like to share a link with you at %s', $permalink );
                $body = sprintf( "%s\r%s", $yoast_description, $permalink );
                // Pinterest
                $description = urlencode( $yoast_description );
                
                $title = urlencode( $title );
                ?>
                <div class="a2a_kit a2a_default_style">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink;?>" target="_blank" rel="nofollow noopener" class="a2a_button_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="https://twitter.com/intent/tweet?text=<?php echo $title;?> - <?php echo $permalink;?>" target="_blank" rel="nofollow noopener" class="a2a_button_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink;?>&title=<?php echo $title;?>&summary=<?php echo $summary;?>&source=<?php echo $thumbnail;?>" target="_blank" rel="nofollow noopener" class="a2a_button_linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                <a href="https://pinterest.com/pin/create/button/?url=<?php echo $permalink;?>&media=<?php echo $thumbnail;?>&description=<?php echo $description;?>" target="_blank" rel="nofollow noopener" class="a2a_button_pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="mailto:?&subject=<?php echo $subject;?>&body=<?php echo $body;?>" target="_blank" rel="nofollow noopener" class="a2a_button_email"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                </div>
                <!--<script async src="https://static.addtoany.com/menu/page.js"></script>-->
                <!-- AddToAny END -->
                <?php
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        the_content();
                    }
                } ?>
            </div>
            
            <button type="button" class="button btn contact-trigger spu-open-990">Contact Us</button>
            
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