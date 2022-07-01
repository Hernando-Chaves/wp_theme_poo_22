<?php

if (!defined('ABSPATH')) : die;
endif;

if (!class_exists('Htwp_Taxonomy_Class')) :

    class Htwp_Taxonomy_Class
    {
        use Htwp_singleton;

        protected $domain;

        public function __construct()
        {
            $this->domain = HTWP_DOMAIN;
            add_action('init', [$this, 'htwp_add_taxonomies']);
        }

        public function htwp_add_taxonomies()
        {
            $taxononomies = [
                [
                    'post_type'         => 'curso',
                    'rewrite'           => 'categoría-curso',
                    'hierarchical'      => true,
                    'public'            => true,
                    'show_ui'           => true,
                    'query_var'         => true,
                    'show_admin_column' => true,
                    'show_in_nav_menus' => true,
                    'show_tagcloud'     => true,
                ],
            ];

            foreach ($taxononomies as $tax) :
                $labels = $this->htwp_add_tax_labels('Categoría', 'Categorías');
                $args   = $this->htwp_tax_args($labels, $tax['rewrite']);
                register_taxonomy($tax['rewrite'], $tax['post_type'], $args);
            endforeach;
        }

        public function htwp_add_tax_labels($plural_name, $singular_name)
        {
            $labels = [
                'name'                       => _x($singular_name, $this->domain),
                'singular_name'              => _x($singular_name,  $this->domain),
                'menu_name'                  => __($singular_name, $this->domain),
                'all_items'                  => __('Todos Items', $this->domain),
                'parent_item'                => __($singular_name . ' Padre', $this->domain),
                'parent_item_colon'          => __($singular_name . ' Padre:', $this->domain),
                'new_item_name'              => __('Agregar ' . $singular_name, $this->domain),
                'add_new_item'               => __('Agregar ' . $singular_name, $this->domain),
                'edit_item'                  => __('Editar ' . $singular_name, $this->domain),
                'update_item'                => __('Actualizar ' . $singular_name, $this->domain),
                'view_item'                  => __('Ver ' . $singular_name, $this->domain),
                'separate_items_with_commas' => __('Separar Elementos Con Comas', $this->domain),
                'add_or_remove_items'        => __('Agregar o remover ' . $plural_name, $this->domain),
                'choose_from_most_used'      => __('Escoja entre los más usados', $this->domain),
                'popular_items'              => __($plural_name . ' más vistos', $this->domain),
                'search_items'               => __('Buscar ' . $plural_name, $this->domain),
                'not_found'                  => __('No se encontraron ' . $plural_name, $this->domain),
                'no_terms'                   => __('No hay ' . $plural_name, $this->domain),
                'items_list'                 => __('Listado de ' . $plural_name, $this->domain),
                'items_list_navigation'      => __('Items list navigation', $this->domain),
            ];

            return $labels;
        }

        public function htwp_tax_args($labels, $rewrite, $hierarchical = true, $public = true, $show_ui = true, $query_var = true, $show_admin_column = true, $show_in_nav_menus = true, $show_tagcloud = true)
        {
            $args = [
                'labels'                     => $labels,
                'rewrite'                    => ['slug'  => $rewrite],
                'hierarchical'               => $hierarchical,
                'public'                     => $public,
                'show_ui'                    => $show_ui,
                'query_var'                  => $query_var,
                'show_admin_column'          => $show_admin_column,
                'show_in_nav_menus'          => $show_in_nav_menus,
                'show_tagcloud'              => $show_tagcloud,
            ];

            return $args;
        }
    }

endif;
