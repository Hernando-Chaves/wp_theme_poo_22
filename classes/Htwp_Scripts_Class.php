<?php

if (!defined('ABSPATH')) : die;
endif;

if (!class_exists('Htwp_Scripts_Class')) :

    class Htwp_Scripts_Class
    {
        use Htwp_singleton;

        protected $hook;

        public function __construct()
        {
            add_action('wp_enqueue_scripts', [$this, 'htwp_public_scripts']);
            add_action('admin_enqueue_scripts', [$this, 'htwp_admin_scripts']);
        }

        public function htwp_admin_scripts($hook)
        {
            global $post;
            $this->hook = $hook;

            if ($this->hook == 'post-new.php' || $this->hook == 'post.php') :
                if ($post->post_type === 'curso' || $post->post_type === 'instructor') :
                    $this->htwp_add_admin_scripts($this->htwp_scripts());
                    $this->htwp_add_admin_styles($this->htwp_styles());
                endif;
            endif;
        }

        public function htwp_add_admin_scripts($scripts)
        {
            $this->htwp_admin_loop_scripts($scripts);
        }

        public function htwp_add_admin_styles($styles)
        {
            $this->htwp_admin_loop_scripts($styles);
        }

        public function htwp_admin_loop_scripts($scripts)
        {
            foreach ($scripts as $handle => $script) :
                $deps      = isset($script['deps']) ? $script['deps']  : '';
                $ver       = isset($script['ver']) ? $script['ver']    : '';
                $media     = isset($script['media']) ? $script['media'] : '';
                $admin     = isset($script['admin']) ? $script['admin'] : '';
                $in_footer = isset($script['in_footer']) ? $script['in_footer'] : '';

                if ($admin == true) :
                    if ($media) :
                        wp_enqueue_style($handle);
                        wp_register_style($handle, $script['src'], $deps, $ver, $media);
                    endif;
                    wp_register_script($handle, $script['src'], $deps, $ver, $in_footer);
                    wp_enqueue_script($handle);
                endif;

            endforeach;
        }

        public function htwp_public_scripts()
        {
            $this->htwp_add_scripts($this->htwp_scripts());
            $this->htwp_add_styles($this->htwp_styles());
        }

        public function htwp_add_scripts($scripts)
        {
            $this->htwp_loop_scripts($scripts);
        }

        public function htwp_add_styles($styles)
        {
            $this->htwp_loop_scripts($styles);
        }

        public function htwp_scripts()
        {
            $scripts = [
                'bootstrapjs' => [
                    'src'         => HTWP_URI . '/libs/bootstrap/js/bootstrap.bundle.min.js',
                    'deps'        => [],
                    'ver'         => '5.1.3',
                    'admin'       => false,
                    'in_footer'   => true,
                ],
                'isotopejs' => [
                    'src'         => HTWP_URI . '/public/assets/js/isotope.min.js',
                    'deps'        => [],
                    'ver'         => '3.0.4',
                    'admin'       => false,
                    'in_footer'   => true,
                ],
                'owljs' => [
                    'src'         => HTWP_URI . '/public/assets/js/owl-carousel.js',
                    'deps'        => [],
                    'ver'         => '2.3.4',
                    'admin'       => false,
                    'in_footer'   => true,
                ],
                'lightboxjs' => [
                    'src'         => HTWP_URI . '/public/assets/js/lightbox.js',
                    'deps'        => [],
                    'ver'         => '2.10.0',
                    'admin'       => false,
                    'in_footer'   => true,
                ],
                'tabjs' => [
                    'src'         => HTWP_URI . '/public/assets/js/tabs.js',
                    'deps'        => [],
                    'ver'         => '1.11.2',
                    'admin'       => false,
                    'in_footer'   => true,
                ],
                'videojs' => [
                    'src'         => HTWP_URI . '/public/assets/js/video.js',
                    'deps'        => [],
                    'ver'         => \filemtime(HTWP_PATH . '/public/assets/js/video.js'),
                    'admin'       => false,
                    'in_footer'   => true,
                ],
                'slickjs' => [
                    'src'         => HTWP_URI . '/public/assets/js/slick-slider.js',
                    'deps'        => [],
                    'ver'         => '1.8.0',
                    'admin'       => false,
                    'in_footer'   => true,
                ],
                'public-customjs' => [
                    'src'         => HTWP_URI . '/public/assets/js/custom.js',
                    'deps'        => [],
                    'ver'         => \filemtime(HTWP_PATH . '/public/assets/js/custom.js'),
                    'admin'       => false,
                    'in_footer'   => true,
                ],
                'chosenjs' => [
                    'src'         => HTWP_URI . '/libs/chosen/js/chosen.jquery.min.js',
                    'deps'        => [],
                    'ver'         => '1.8.7',
                    'admin'       => true,
                    'in_footer'   => true,
                ],
                'admin-custom' => [
                    'src'         => HTWP_URI . '/admin/assets/js/admin.js',
                    'deps'        => [],
                    'ver'         => \filemtime(HTWP_PATH . '/admin/assets/js/admin.js'),
                    'admin'       => true,
                    'in_footer'   => true,
                ],

            ];

            return $scripts;
        }

        public function htwp_styles()
        {
            $styles = [
                'stylesheet' => [
                    'src'   => HTWP_URI . '/style.css',
                    'deps'  => [],
                    'ver'   => \filemtime(HTWP_PATH . '/style.css'),
                    'media' => 'all',
                    'admin' => false,
                ],
                'bootstrapcss' => [
                    'src'   => HTWP_URI . '/libs/bootstrap/css/bootstrap.min.css',
                    'deps'  => [],
                    'ver'   => '5.1.3',
                    'media' => 'all',
                    'admin' => false,
                ],
                'fontawesomecss' => [
                    'src'   => HTWP_URI . '/public/assets/css/fontawesome.css',
                    'deps'  => [],
                    'ver'   => '4.3.0',
                    'media' => 'all',
                    'admin' => false,
                ],
                'themecss' => [
                    'src'   => HTWP_URI . '/public/assets/css/templatemo-edu-meeting.css',
                    'deps'  => [],
                    'ver'   => \filemtime(HTWP_PATH . '/public/assets/css/templatemo-edu-meeting.css'),
                    'media' => 'all',
                    'admin' => false,
                ],
                'owlcss' => [
                    'src'   => HTWP_URI . '/public/assets/css/owl.css',
                    'deps'  => [],
                    'ver'   => '2.3.4',
                    'media' => 'all',
                    'admin' => false,
                ],
                'lightboxcss' => [
                    'src'   => HTWP_URI . '/public/assets/css/lightbox.css',
                    'deps'  => [],
                    'ver'   => \filemtime(HTWP_PATH . '/public/assets/css/lightbox.css'),
                    'media' => 'all',
                    'admin' => false,
                ],
                'chosencss' => [
                    'src'   => HTWP_URI . '/libs/chosen/css/chosen.css',
                    'deps'  => [],
                    'ver'   => \filemtime(HTWP_PATH . '/libs/chosen/css/chosen.css'),
                    'media' => 'all',
                    'admin' => true,
                ],
                'chosenstyle' => [
                    'src'   => HTWP_URI . '/libs/chosen/css/style.css',
                    'deps'  => [],
                    'ver'   => \filemtime(HTWP_PATH . '/libs/chosen/css/style.css'),
                    'media' => 'all',
                    'admin' => true,
                ],
                'publiccss' => [
                    'src'   => HTWP_URI . '/public/assets/css/public.css',
                    'deps'  => [],
                    'ver'   => \filemtime(HTWP_PATH .  '/public/assets/css/public.css'),
                    'media' => 'all',
                    'admin' => true,
                ],
            ];

            return $styles;
        }

        public function htwp_loop_scripts($scripts)
        {
            foreach ($scripts as $handle => $script) :
                $deps      = isset($script['deps']) ? $script['deps']  : '';
                $ver       = isset($script['ver']) ? $script['ver']    : '';
                $media     = isset($script['media']) ? $script['media'] : '';
                $in_footer = isset($script['in_footer']) ? $script['in_footer'] : '';

                if ($media) :
                    wp_enqueue_style($handle);
                    wp_register_style($handle, $script['src'], $deps, $ver, $media);
                endif;
                wp_register_script($handle, $script['src'], $deps, $ver, $in_footer);
                wp_enqueue_script($handle);
            endforeach;
        }
    }

endif;
