<footer class="main-footer">
    <?php wp_footer(); ?>
    <div class="footer-wrap">
        <div class="social-media">
            <?php if (get_field( 'facebook_link', 'option' )) : ?>
                <a class="facebook" target="_blank" href="<?php echo esc_url( get_field( 'facebook_link', 'option' ) ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <?php endif ?>

            <?php if (get_field( 'houzz_link', 'option' )) : ?>
                <a class="houzz" target="_blank" href="<?php echo esc_url( get_field( 'houzz_link', 'option' ) ); ?>"><i class="fa fa-houzz" aria-hidden="true"></i></a>
            <?php endif ?>
            <?php if (get_field( 'dwell_link', 'option' )) : ?>
                <a class="dwell" target="_blank" href="<?php echo esc_url( get_field( 'dwell_link', 'option' ) ); ?>">Dwell</a>
            <?php endif ?>
            <?php if (get_field( 'blog_link', 'option' )) : ?>
                <a class="blog" target="_blank" href="<?php echo esc_url( get_field( 'blog_link', 'option' ) ); ?>">Blog</a>
            <?php endif ?>
        </div>
        <span class="copyright">Copyright &copy; <?php echo date("Y"); ?> Studio Zerbey | <?php echo esc_html( get_field('studio_location', 'option') ); ?> | All Rights Reserved</span>
    </div>
</footer>