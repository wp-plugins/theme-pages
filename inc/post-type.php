<?php


defined('ABSPATH') or die('No script kiddies please!');


function tpages_register_post_type() {
  $labels = array(
    'name'               => _x('Theme Pages', 'post type general name', THEME_PAGES_NS),
    'singular_name'      => _x('Theme Page', 'post type singular name', THEME_PAGES_NS),
    'menu_name'          => _x('Theme Pages', 'admin menu', THEME_PAGES_NS),
    'name_admin_bar'     => _x('Theme Page', 'add new on admin bar', THEME_PAGES_NS),
    'add_new'            => _x('Add New', 'book', THEME_PAGES_NS),
    'add_new_item'       => __('Add New Theme Page', THEME_PAGES_NS),
    'new_item'           => __('New Theme Page', THEME_PAGES_NS),
    'edit_item'          => __('Configure Theme Page', THEME_PAGES_NS),
    'view_item'          => __('View Theme Page', THEME_PAGES_NS),
    'all_items'          => __('All Theme Pages', THEME_PAGES_NS),
    'search_items'       => __('Search Theme Pages', THEME_PAGES_NS),
    'parent_item_colon'  => __('Parent Theme Pages:', THEME_PAGES_NS),
    'not_found'          => __('No theme pages found.', THEME_PAGES_NS),
    'not_found_in_trash' => __('No theme pages found in Trash.', THEME_PAGES_NS)
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'show_in_nav_menus'  => true,
    'show_in_admin_bar'  => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'page'),
    'capability_type'    => 'page',
    'has_archive'        => false,
    'hierarchical'       => true,
    'menu_position'      => 20,
    'supports'           => array('title', 'excerpt'),
    'taxonomies'         => array('category', 'post_tag')
  );

  register_post_type('theme-page', $args);
}


add_action('init', 'tpages_register_post_type');