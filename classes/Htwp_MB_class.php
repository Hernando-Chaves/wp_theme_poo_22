<?php

if (!defined('ABSPATH')) : die;
endif;

if (!class_exists('Htwp_MB_class')) :

    class Htwp_Mb_class
    {
        use Htwp_singleton;
        protected $post_id;

        public function __construct()
        {
            add_action('save_post', [$this, 'htwp_save_metaboxes']);
            add_action('add_meta_boxes', [$this, 'htwp_add_metaboxes']);
        }

        public function htwp_add_metaboxes()
        {
            $post_id = $_GET['post'] ? $_GET['post'] : $_GET['post_ID'];

            if (!isset($post_id))  return;

            $screens = ['Cursos'];

            foreach ($screens as $screen) :
                if (get_the_title($post_id) == $screen) :
                    add_meta_box(
                        'title_cursos',
                        __('Titulo de la página', HTWP_DOMAIN),
                        [$this, 'htwp_view_cursos_page'],
                        'page',
                        'normal',
                        'hight',
                        null
                    );
                endif;
            endforeach;



            add_meta_box(
                'info_curso_mb',
                __('Información del curso', HTWP_DOMAIN),
                [$this, 'htwp_view_curso'],
                'curso',
                'normal',
                'high',
                null
            );

            add_meta_box(
                'info_instructor',
                __('Infomación del instructor', HTWP_DOMAIN),
                [$this, 'htwp_view_instructor'],
                'instructor',
                'normal',
                'high',
                null
            );
        }

        public function htwp_view_curso($object)
        {
            wp_nonce_field('nonce_htwp_security', 'nonce_htwp');
            require_once HTWP_PATH . '/includes/mb_curso_view.php';
        }

        public function htwp_view_instructor($object)
        {
            wp_nonce_field('nonce_htwp_security', 'nonce_htwp');
            require_once HTWP_PATH . '/includes/mb_instructor_view.php';
        }

        public function htwp_view_cursos_page($object)
        {
            wp_nonce_field('nonce_htwp_security', 'nonce_htwp');
            require_once HTWP_PATH . '/includes/mb_cursos_page_view.php';
        }

        public function htwp_save_metaboxes($post_id)
        {
            if (!isset($_POST['nonce_htwp']) && !wp_verify_nonce($_POST['nonce_htwp'], 'nonce_htwp_security')) :
                return $post_id;
            endif;

            if (!current_user_can('edit_post', $post_id)) :
                return $post_id;
            endif;

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) :
                return $post_id;
            endif;
            $this->htwp_save_mb_fields($this->htwp_get_fields(), $post_id);
        }

        public function htwp_save_mb_fields($fields, $post_id)
        {
            global $post;
            $post_type = $post->post_type;

            foreach ($fields[$post_type] as $handle => $field) :

                if (isset($_POST[$field]) && !empty($_POST[$field])) :
                    $value = sanitize_text_field($_POST[$field]);
                    if ($field == 'especialidades') :
                        $especialidades = [];
                        foreach ($_POST['especialidades'] as $especialidad) :
                            $especialidades[] = sanitize_text_field($especialidad);
                            update_post_meta($post_id, 'especialidades', maybe_serialize($especialidades));
                        endforeach;
                    else :
                        update_post_meta($post_id, $field, $value);
                    endif;
                endif;
            endforeach;
        }

        public function htwp_get_fields()
        {
            $fields = [
                'curso' => [
                    'precio',
                    'descripcion_corta',
                    'lugar',
                    'horario',
                    'instructor_curso'
                ],
                'instructor' => [
                    'short_instructor',
                    'especialidades'
                ],
            ];

            return $fields;
        }
    }

endif;
