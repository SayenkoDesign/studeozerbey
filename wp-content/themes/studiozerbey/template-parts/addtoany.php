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