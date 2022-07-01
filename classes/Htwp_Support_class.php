<?php

if (!defined('ABSPATH')) : die;
endif;

if (!class_exists('Htwp_Support_class')) :

    class Htwp_Support_class
    {
        use Htwp_singleton;

        public function __construct()
        {
            add_action('after_setup_theme', [$this, 'htwp_add_theme_support']);
        }

        public function htwp_add_theme_support()
        {
            add_theme_support('title-tag');

            add_theme_support('custom-logo', [
                'width'                => 200,
                'height'               => 75,
                'flex-width'           => false,
                'flex-height'          => false,
                'unlink-homepage-logo' => true,

            ]);

            add_theme_support('post-thumbnails');

            add_theme_support('html5', [
                'search-form',
                'comment-form',
                'gallery',
                'caption',
                'script',
                'style'
            ]);
        }
    }

endif;
