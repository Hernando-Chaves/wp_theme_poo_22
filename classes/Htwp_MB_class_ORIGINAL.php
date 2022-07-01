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
            add_action('add_meta_boxes', [$this, 'htwp_add_metaboxes']);
            add_action('save_post', [$this, 'htwp_save_metaboxes']);
        }

        public function htwp_add_metaboxes()
        {
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
            $this->htwp_save_mb_fields($this->htwp_get_fields_curso(), $post_id);
            $this->htwp_save_mb_fields($this->htwp_get_fields_instructor(), $post_id);
        }

        public function htwp_save_mb_fields($fields, $post_id)
        {
            foreach ($fields as $handle => $field) :
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

        public function htwp_get_fields_curso()
        {
            $curso = ['precio', 'descripcion_corta', 'lugar', 'horario', 'instructor_curso'];

            return $curso;
        }

        public function htwp_get_fields_instructor()
        {
            $instructor = ['short_instructor', 'especialidades'];

            return $instructor;
        }
    }

endif;
