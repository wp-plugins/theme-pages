<?php
/**
Plugin Name: Theme Pages
Plugin URI: https://steven-bailey.com/theme-pages-plugin/
Description: Provide custom pages for your blog through automatically mapped theme templates. Great for custom HTML and static content!
Author: Steve Bailey
Author URI: http://steven-bailey.com/
Text Domain: theme-pages
Version: 1.1
*/


defined('ABSPATH') or die('No script kiddies please!');


define('THEME_PAGES_NS', 'theme-pages');


function tpages_activate() { }


register_activation_hook(__FILE__, 'tpages_activate');


include 'inc/functions.php';
include 'inc/post-type.php';
include 'inc/mata-boxes.php';
include 'inc/templates.php';