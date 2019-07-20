<?php

function zerbey_register_cpts()
{

    /**
     * Post Type: Projects.
     */

    $labels = array(
        "name" => __("Projects", "twentyfifteen"),
        "singular_name" => __("Project", "twentyfifteen"),
    );

    $args = array(
        "label" => __("Projects", "twentyfifteen"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "project", "with_front" => false),
        "query_var" => true,
        "menu_icon" => "dashicons-admin-home",
        "supports" => array("title", "editor", "thumbnail", "excerpt", "revisions"),
        "taxonomies" => array("project_type"),
    );

    register_post_type("project", $args);

    /**
     * Post Type: Testimonials.
     */

    $labels = array(
        "name" => __("Testimonials", "twentyfifteen"),
        "singular_name" => __("Testimonial", "twentyfifteen"),
    );

    $args = array(
        "label" => __("Testimonials", "twentyfifteen"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "testimonial", "with_front" => true),
        "query_var" => true,
        "menu_icon" => "dashicons-format-quote",
        "supports" => array("title", "editor", "thumbnail"),
    );

    register_post_type("testimonial", $args);
}

add_action('init', 'zerbey_register_cpts');
