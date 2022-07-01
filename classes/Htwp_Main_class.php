<?php

if (!defined('ABSPATH')) : die;
endif;

if (!class_exists('Htwp_Main_Class')) :

    class Htwp_Main_Class
    {
        use Htwp_singleton;

        public function __construct()
        {
            Htwp_Scripts_Class::htwp_get_instance();
            Htwp_Cpt_Class::htwp_get_instance();
            Htwp_Config_Menu_Class::htwp_get_instance();
            Htwp_Support_class::htwp_get_instance();
            Htwp_Mb_class::htwp_get_instance();
            Htwp_Taxonomy_Class::htwp_get_instance();
        }
    }

endif;
