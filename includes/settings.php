<?php

if (!defined('HTWP_PATH')) :
    define('HTWP_PATH', untrailingslashit(get_theme_file_path()));
endif;

if (!defined('HTWP_URI')) :
    define('HTWP_URI', untrailingslashit(get_theme_file_uri()));
endif;

if (!defined('HTWP_VERSION')) :
    define('HTWP_VERSION', '1.0.0');
endif;

if (!defined('HTWP_DOMAIN')) :
    define('HTWP_DOMAIN', 'htwp_domain');
endif;


if (!defined('HTWP_THEME_NAME')) :
    define('HTWP_THEME_NAME', 'htwp');
endif;

global $content_width;
if (!isset($content_width)) :
    $content_width = 150;
endif;

add_filter('show_admin_bar', '__return_false');
add_filter('use_block_editor_for_post', '__return_false');
add_action('init', 'htwp_remove_clasic_editor');

function htwp_remove_clasic_editor()
{
    $post_id = $_GET['post'] ? $_GET['post'] : $_GET['post_ID'];

    if (!isset($post_id)) return;
    $page_title = get_the_title($post_id);
    if ($page_title == 'Cursos') :
        remove_post_type_support('page', 'editor');
    endif;
}
