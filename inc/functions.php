<?php


defined('ABSPATH') or die('No script kiddies please!');


/**
 * Attempts to find a template to display for a theme page.
 * @param WP_Post $theme_page
 * @return null|string
 */
function tpages_get_template_filename($theme_page) {
  $child_file = get_stylesheet_directory() . '/pages/' . $theme_page->post_name . '.php';
  if (file_exists($child_file)) {
    return $child_file;
  }

  $theme_file = get_template_directory() . '/pages/' . $theme_page->post_name . '.php';
  if (file_exists($theme_file)) {
    return $theme_file;
  }

  return null;
}


/**
 * Determine weather a template for a theme page exists.
 * @param WP_Post $theme_page
 * @return bool
 */
function tpages_page_exists($theme_page) {
  $file = tpages_get_template_filename($theme_page);
  return !is_null($file);
}


/**
 * Gets weather a child theme is in use.
 * @return bool
 */
function tpages_has_child_theme() {
  return get_stylesheet_directory_uri() == get_template_directory_uri();
}