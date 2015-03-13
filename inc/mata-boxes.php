<?php


defined('ABSPATH') or die('No script kiddies please!');


function tpages_add_meta_boxes() {
  add_meta_box(
    'tpages_meta_instructions',
    __('Developer Instructions', THEME_PAGES_NS),
    'tpages_meta_instructions_callback',
    'theme-page'
  );
}


function tpages_meta_get_status($path) {
  $result = new stdClass();
  $result->short_file = str_replace(ABSPATH, '', $path);
  if (file_exists($path)) {
    $result->status = 'Available';
    $result->class = 'status available';
    $result->exists = true;
    $result->dashicon = 'dashicons-yes';
  }
  else {
    $result->status = 'Missing!';
    $result->class = 'status missing';
    $result->exists = false;
    $result->dashicon = 'dashicons-no';
  }
  return $result;
}


function tpages_meta_instructions_callback($theme_page) {
  $parent = tpages_meta_get_status(get_template_directory() . '/pages/' . $theme_page->post_name . '.php');
  $child = tpages_meta_get_status(get_stylesheet_directory() . '/pages/' . $theme_page->post_name . '.php');

  if (strpos($parent->short_file, '/.php') > 0) {
    echo '<div>This section will unlock once you publish the page</div>';
    return;
  }

  if ($child->exists && !tpages_has_child_theme()) {
    $child->status = 'Used';
    $child->class = 'status used';
    $child->dashicon = 'dashicons-star-filled';
  }
  elseif ($parent->exists) {
    $parent->status = 'Used';
    $parent->class = 'status used';
    $parent->dashicon = 'dashicons-star-filled';
  }

  ?>
  <style type="text/css" scoped>
    .tpl-table table { border-collapse: collapse; }
    .tpl-table table, .tpl-table tr, .tpl-table td, .tpl-table .th {
      border: 1px solid #ccc;
      box-sizing: border-box;
      overflow: visible;
    }
    .tpl-table table thead th { text-align: left; padding: 5px 10px; }
    .tpl-table table thead th:nth-of-type(1) { width:120px; }
    .tpl-table table thead th:nth-of-type(3) { max-width:190px; }
    .tpl-table table tbody td { padding: 5px 10px; }
    .tpl-table table tbody .status.missing { color:red; }
    .tpl-table table tbody .status.available { color:gray; }
    .tpl-table table tbody .status.used { color:green; }
    .tpl-table table tbody .dashicons { width: 15px; height: 15px; font-size: 15px; vertical-align: sub; }
  </style>
  <div class="tpl-table">
    <p>
      <?php _e('Content for this page must be provided through a page template located either within your theme or child' .
      'theme folder. A template in the child theme will always override the parent theme. Use the table below as a' .
      'guide to help you create the template in the right location:', THEME_PAGES_NS); ?>
    </p>
    <table>
      <thead>
      <tr>
        <th><?php _e('Theme', THEME_PAGES_NS); ?></th>
        <th><?php _e('File Location', THEME_PAGES_NS); ?></th>
        <th><?php _e('Status', THEME_PAGES_NS); ?></th>
      </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php _e('Parent', THEME_PAGES_NS); ?></td>
          <td><?php echo $parent->short_file; ?></td>
          <td class="<?php echo $parent->class; ?>"><i class="dashicons <?php echo $parent->dashicon; ?>"></i>&nbsp;<?php _e($parent->status, THEME_PAGES_NS); ?></td>
        </tr>
        <tr>
          <td><?php _e('Child Theme', THEME_PAGES_NS); ?></td>
          <td><?php echo $child->short_file; ?></td>
          <td class="<?php echo $child->class; ?>"><i class="dashicons <?php echo $child->dashicon; ?>"></i>&nbsp;<?php _e($child->status, THEME_PAGES_NS); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
<?php
}


add_action('add_meta_boxes', 'tpages_add_meta_boxes');