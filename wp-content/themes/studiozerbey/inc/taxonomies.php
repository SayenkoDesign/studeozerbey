<?php

function zerbey_register_taxonomies()
{

    /**
     * Taxonomy: Project Types.
     */

    $labels = array(
        "name" => __("Project Types", "twentyfifteen"),
        "singular_name" => __("Project Type", "twentyfifteen"),
        "menu_name" => __("Project Types", "twentyfifteen"),
        "all_items" => __("All Project Types", "twentyfifteen"),
        "edit_item" => __("Edit Project Type", "twentyfifteen"),
        "view_item" => __("View Project Type", "twentyfifteen"),
        "update_item" => __("Update Project Type", "twentyfifteen"),
        "add_new_item" => __("Add Project Type", "twentyfifteen"),
        "new_item_name" => __("New Project Type", "twentyfifteen"),
        "parent_item" => __("Parent Type", "twentyfifteen"),
        "parent_item_colon" => __("Parent Type:", "twentyfifteen"),
        "search_items" => __("Search Types", "twentyfifteen"),
        "popular_items" => __("Popular Types", "twentyfifteen"),
        "separate_items_with_commas" => __("Separate Types with commas", "twentyfifteen"),
        "add_or_remove_items" => __("Add or remove types", "twentyfifteen"),
        "choose_from_most_used" => __("Choose from Most Used types", "twentyfifteen"),
        "not_found" => __("Types not found", "twentyfifteen"),
        "no_terms" => __("No types", "twentyfifteen"),
        "items_list_navigation" => __("Types list navigation", "twentyfifteen"),
        "items_list" => __("Types list", "twentyfifteen"),
    );

    $args = array(
        "label" => __("Project Types", "twentyfifteen"),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => false,
        "label" => "Project Types",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'projects', 'with_front' => true,),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false,
        'has_archive' => true,
    );
    register_taxonomy("project_type", array("project"), $args);
}

add_action('init', 'zerbey_register_taxonomies');
