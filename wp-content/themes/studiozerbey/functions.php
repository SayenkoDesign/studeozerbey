<?php
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page('Site Settings');
}

function studiozerbey_scripts() {
    wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/js/slick/slick.css', array() );
    wp_enqueue_style( 'lity-css', get_template_directory_uri() . '/js/lity/lity.min.css', array() );
    wp_enqueue_style( 'studiozerbey-theme-style', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick/slick.min.js', array('jquery') , null);
    wp_enqueue_script( 'lity-js', get_template_directory_uri() . '/js/lity/lity.min.js', array('jquery') , null);
    wp_enqueue_script( 'studio-zerbey-js', get_template_directory_uri() . '/js/studio-zerbey.js', array('jquery'), '0.1', true );
}
add_action( 'wp_enqueue_scripts', 'studiozerbey_scripts' );



include_once('inc/cpts.php');
include_once('inc/taxonomies.php');

include_once('inc/projects.php');
include_once('inc/resources.php');
include_once('inc/icon.php');

add_action('admin_head-nav-menus.php', 'wpclean_add_metabox_menu_posttype_archive');

function wpclean_add_metabox_menu_posttype_archive() {
    add_meta_box('wpclean-metabox-nav-menu-posttype', 'Custom Post Type Archives', 'wpclean_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}

function wpclean_metabox_menu_posttype_archive() {
    $post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');

    if ($post_types) :
        $items = array();
        $loop_index = 999999;

        foreach ($post_types as $post_type) {
            $item = new stdClass();
            $loop_index++;

            $item->object_id = $loop_index;
            $item->db_id = 0;
            $item->object = 'post_type_' . $post_type->query_var;
            $item->menu_item_parent = 0;
            $item->type = 'custom';
            $item->title = $post_type->labels->name;
            $item->url = get_post_type_archive_link($post_type->query_var);
            $item->target = '';
            $item->attr_title = '';
            $item->classes = array();
            $item->xfn = '';

            $items[] = $item;
        }

        $walker = new Walker_Nav_Menu_Checklist(array());

        echo '<div id="posttype-archive" class="posttypediv">';
        echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
        echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
        echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
        echo '</ul>';
        echo '</div>';
        echo '</div>';

        echo '<p class="button-controls">';
        echo '<span class="add-to-menu">';
        echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
        echo '<span class="spinner"></span>';
        echo '</span>';
        echo '</p>';

    endif;
}


function set_project_taxonomy_menu_class( $classes, $item ) {

    if ( (is_tax('project_type') || get_post_type() == "project" ) && $item->title == "Projects") {
        $classes[] = 'current-menu-item';
    }

    return $classes;

}

add_filter( 'nav_menu_css_class', 'set_project_taxonomy_menu_class', 10, 2 );

add_theme_support( 'post-thumbnails' );

add_theme_support( 'title-tag' );

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
    'primary'       => esc_html__( 'Primary Menu', '_s' ),
    'resources'     => esc_html__( 'Resources Menu', '_s' )
) );


//custom image sizes

add_image_size( 'medium_large', '768', '0', false );
add_image_size( 'project-box', '460', '306', array( "center", "center") );
add_image_size( 'medium_large', '768', '0', false );
add_image_size( 'project-fullwidth', '1440', '0', false );
add_image_size( 'project-mobile', '480', '0', false );
add_image_size( 'project-gallery-thumb', '352', '352', true );

// Gutenberg just for posts
add_filter( 'use_block_editor_for_post_type', function ( $use_block_editor, $post_type ) {
	if ( 'post' !== $post_type ) {
		return false;
	}
	return $use_block_editor;
}, 10, 2 );



function disable_sharedaddy() {
    add_filter( 'sharing_show', '__return_false' );
}
add_action( 'init', 'disable_sharedaddy' );



// BE Media From Production
function prefix_production_url( $url ) {
	return 'https://studiozerbey.com';
}
// add_filter( 'be_media_from_production_url', 'prefix_production_url' );