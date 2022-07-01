<?php

function htwp_autoload($class)
{
    add_filter('theme_file_path', 'wp_normalize_path');

    if (0 !== strpos($class, 'Htwp_')) :
        return;
    endif;

    $extension   = '.php';
    $path        = untrailingslashit(get_theme_file_path()) . '/';
    $directories = ['admin/', 'classes/', 'public/'];

    foreach ($directories as $dir) :
        $full_path = $path . $dir . $class . $extension;
        if (file_exists($full_path)) :
            require_once($full_path);
        endif;
    endforeach;
}

spl_autoload_register('htwp_autoload');
