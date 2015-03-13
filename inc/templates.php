<?php


defined('ABSPATH') or die('No script kiddies please!');


function tpages_handle_template($single_template) {
  global $post;

  if ($post->post_type == 'theme-page') {
    $potential_template = tpages_get_template_filename($post);
    if (!is_null($potential_template)) {
      $single_template = $potential_template;
    }
  }

  return $single_template;
}


add_filter('single_template', 'tpages_handle_template');