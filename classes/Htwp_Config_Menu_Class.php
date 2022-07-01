<?php

if (!defined('ABSPATH')) : die;
endif;

if (!class_exists('Htwp_Config_Menu_Class')) :

    class Htwp_Config_Menu_Class
    {
        use Htwp_singleton;
        public function __construct()
        {
            $this->htwp_register_menus();
        }

        public function htwp_register_menus()
        {
            register_nav_menus([
                'menu_principal' => __('Menu Principal', HTWP_DOMAIN)
            ]);
        }

        public function htwp_get_nav_locations($location)
        {
            $locations   = get_nav_menu_locations();
            $id_location = $locations[$location];

            return !empty($id_location) ? $id_location : '';
        }

        public function htwp_get_child_menus($array, $parent_id)
        {
            $child_menus = [];

            if (!empty($array) && is_array($array)) :
                foreach ($array as $item) :
                    if (intval($item->menu_item_parent)  === $parent_id) :
                        array_push($child_menus, $item);
                    endif;
                endforeach;
            endif;

            return $child_menus;
        }
    }

endif;
