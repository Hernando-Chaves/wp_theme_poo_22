<?php
$class     = Htwp_Config_Menu_Class::htwp_get_instance();
$menu_id   = $class->htwp_get_nav_locations('menu_principal');
$all_items = wp_get_nav_menu_items($menu_id);
?>
<!-- Sub Header -->
<div class="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-8">
                <div class="left-content">
                    <p>This is an educational <em>HTML CSS</em> template by TemplateMo website.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="right-icons">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a class="logo">
                        <?php
                        if (function_exists('the_custom_logo')) :
                            the_custom_logo();
                        endif;
                        ?>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <?php
                    if (!empty($all_items) && is_array($all_items)) : ?>
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <?php
                            foreach ($all_items as $menu) :
                                if (!$menu->menu_item_parent) :
                                    $child_items = $class->htwp_get_child_menus($all_items, $menu->ID);
                                    $has_children = !empty($child_items) && is_array($child_items);
                                    if (!$has_children) : ?>
                                        <li class="scroll-to-section">
                                            <a href="<?php echo esc_url($menu->url) ?>" class="active"><?php echo esc_html($menu->title) ?></a>
                                        </li>
                                    <?php else : ?>
                                        <li class="has-sub">
                                            <a href="<?php echo esc_html($menu->url) ?>"><?php echo esc_html($menu->title) ?></a>
                                            <ul class="sub-menu">
                                                <?php
                                                if (!empty($child_items) && is_array($child_items)) :
                                                    foreach ($child_items as $item) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_html($item->url) ?>"><?php echo esc_html($item->title) ?></a>
                                                        </li>
                                                <?php endforeach;
                                                endif;

                                                ?>
                                            </ul>
                                        </li>
                            <?php endif;

                                endif;
                            endforeach;
                            ?>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    <?php endif;
                    ?>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->