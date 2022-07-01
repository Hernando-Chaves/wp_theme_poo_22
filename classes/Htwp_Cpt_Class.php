<?php

if (!defined('ABSPATH')) : die;
endif;

if (!class_exists('Htwp_Cpt_Class')) :

    class Htwp_Cpt_Class
    {
        use Htwp_singleton;

        protected $domain;

        public function __construct()
        {
            $this->domain = HTWP_DOMAIN;
            add_action('init', [$this, 'htwp_add_cpt']);
        }

        public function htwp_add_cpt()
        {
            $post_types = [
                [
                    'singular'     => __('Curso', $this->domain),
                    'plural'       => __('Cursos', $this->domain),
                    'slug'         => 'curso',
                    'supports'     => ['title', 'editor', 'thumbnail'],
                    'icon'         => 'dashicons-welcome-learn-more',
                    'show_in_menu' => true,
                    'position'     => 15,
                ],
                [
                    'singular'     => __('Instructor', $this->domain),
                    'plural'       => __('Instructores', $this->domain),
                    'slug'         => 'instructor',
                    'supports'     => ['title', 'editor', 'thumbnail'],
                    'show_in_menu' => true,
                    'icon'         => 'dashicons-businessman',
                    'position'     => 20,
                ]
            ];

            foreach ($post_types as  $post_type) :
                $labels = $this->htwp_add_labels($post_type['singular'], $post_type['plural']);
                $args   = $this->htwp_add_args($post_type['singular'],  $labels, $post_type['supports'], $post_type['icon'], $post_type['show_in_menu'], $post_type['position']);
                $this->htwp_register_post_type($post_type['slug'], $args);
            endforeach;
            flush_rewrite_rules();
        }

        public function htwp_add_labels($singular_name, $plural_name)
        {
            $labels = [
                'name'                  => _x($plural_name, 'Post Type General Name', $this->domain),
                'singular_name'         => _x($singular_name, 'Post Type Singular Name', $this->domain),
                'menu_name'             => __($plural_name, $this->domain),
                'name_admin_bar'        => __($plural_name, $this->domain),
                'parent_item_colon'     => __($plural_name . ' Padre:', $this->domain),
                'all_items'             => __('Todos los ' . $plural_name, $this->domain),
                'add_new_item'          => __('Agregar Nuevo ' . $singular_name, $this->domain),
                'add_new'               => __('Agregar Nuevo ' . $singular_name, $this->domain),
                'new_item'              => __('Nuevo ' . $singular_name, $this->domain),
                'edit_item'             => __('Editar ' . $singular_name, $this->domain),
                'update_item'           => __('Actualizar ' . $singular_name, $this->domain),
                'view_item'             => __('Ver ' . $singular_name, $this->domain),
                'view_items'            => __('Ver ' . $plural_name, $this->domain),
                'search_items'          => __('Buscar ' . $singular_name, $this->domain),
                'not_found'             => __('No se encontraron ' . $plural_name, $this->domain),
                'not_found_in_trash'    => __('No hay ' . $plural_name . ' en la papelera', $this->domain),
                'featured_image'        => __('Imagen Destacada', $this->domain),
                'set_featured_image'    => _x('Añadir imagen destacada', '', $this->domain),
                'remove_featured_image' => _x('Borrar imagen', '', $this->domain),
                'use_featured_image'    => _x('Usar como imagen', '', $this->domain),
                'archives'              => _x($plural_name . ' Archivo', '', $this->domain),
                'insert_into_item'      => _x('Insertar en ' . $singular_name, '', $this->domain),
                'uploaded_to_this_item' => _x('Cargado en este ' . $singular_name, '', $this->domain),
                'filter_items_list'     => _x('Filtrar ' . $plural_name . ' por lista', '”. Agregado en 4.4', $this->domain),
                'items_list_navigation' => _x('Navegación de ' . $plural_name, '', $this->domain),
                'items_list'            => _x('Lista de ' . $plural_name, '', $this->domain),
            ];

            return $labels;
        }

        public function htwp_add_args($label, $labels, $supports, $icon, $show_in_menu, $position)
        {
            $args = [
                'label'                 => __($label, $this->domain),
                // 'description'           => __('Recetas para cocina', $this->domain),
                'labels'                => $labels,
                'supports'              => $supports,
                'taxonomies'            => [],
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => $show_in_menu,
                'menu_icon'             => $icon,
                // 'rewrite'               => ['slug'  =>  'quizes'],
                'menu_position'         => $position,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => false,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                // 'capability_type'       => ['quiz', 'quizes'],
                'query_var'             => true,
                'map_meta_cap'          => true,
            ];

            return $args;
        }

        public function htwp_register_post_type($cpt_name, $args)
        {
            register_post_type(strtolower(trim($cpt_name)), $args);
        }
    }

endif;
