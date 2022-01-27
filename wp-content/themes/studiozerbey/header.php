<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <meta name="google-site-verification" content="2TpejPFnbIH0M7l3MI5jk18MrlxH5EGKdJNQh1ie4FM" />
	
		<!-- pinterest varification code -->

	<meta name="p:domain_verify" content="03da2fbae0cce8225a4c03d0b1aed49f"/>


	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141053484-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-141053484-1');
</script>

	
	
</head>
<body <?php body_class();?>>
<header class="main-header">
    <div class="logo">
        <a href="<?php echo esc_url( home_url() ); ?>">
            <?php if (esc_url( get_field( 'logo_image', 'option' ) )): ?>
                <img src="esc_url( get_field( 'logo_image', 'option' ) )" height="136px" alt="">
            <?php else : ?>
                <span class="logo-primary">Studio Zerbey</span>
                <span class="logo-secondary">Architecture + Design</span>
            <?php endif ?>
        </a>
    </div>
    <nav class="primary-menu">
        <?php wp_nav_menu( array()); ?>
    </nav>
</header>