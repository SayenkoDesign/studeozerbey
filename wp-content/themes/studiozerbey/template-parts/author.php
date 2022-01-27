<div class="author">
<?php
echo get_avatar( get_the_author_meta( 'ID' ), 56 );

printf( '<span>%s</span>',  get_the_author_meta( 'display_name' ) );
?>
</div>