<?php

require_once get_theme_file_path('/includes/settings.php');
require_once HTWP_PATH . '/includes/trait-singleton.php';
require_once HTWP_PATH . '/includes/autoload.php';

function htwp_instance_main_class()
{
    Htwp_Main_Class::htwp_get_instance();
}
htwp_instance_main_class();
