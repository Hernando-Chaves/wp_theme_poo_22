<table class="form-table">
    <tr class="row-title">
        <th><?php echo __('Precio', HTWP_DOMAIN) ?></th>
        <td>
            <input type="number" class="regular-text" name="precio" value="<?php echo get_post_meta($object->ID, 'precio', true) ?>">
        </td>
    </tr>
    <tr class="row-title">
        <th><?php echo __('Descripción corta', HTWP_DOMAIN) ?></th>
        <td>
            <textarea name="descripcion_corta" id="descripcion_corta" cols="46" rows="3">
                <?php
                echo get_post_meta($object->ID, 'descripcion_corta', true);
                ?>
            </textarea>
        </td>
    </tr>
    <tr class="row-title">
        <th><?php echo __('Lugar', HTWP_DOMAIN) ?></th>
        <td>
            <input type="text" class="regular-text" name="lugar" value="<?php echo get_post_meta($object->ID, 'lugar', true) ?>">
        </td>
    </tr>
    <tr class="row-title">
        <th><?php echo __('Horario', HTWP_DOMAIN) ?></th>
        <td>
            <input type="text" class="regular-text" name="horario" value="<?php echo get_post_meta($object->ID, 'horario', true) ?>">
        </td>
    </tr>
    <tr class="row-title">
        <?php
        $args = [
            'post_type'      => 'instructor',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ];

        $instructores = new WP_Query($args);
        ?>
        <th>Instructor</th>
        <td>
            <select class="regular-text" name="instructor_curso" id="instructor_curso">
                <option value="0">Selecciona un instructor</option>
                <?php
                if ($instructores->have_posts()) :

                    while ($instructores->have_posts()) : $instructores->the_post();
                        global $post;
                        $instructor = get_post_meta($object->ID, 'instructor_curso', true);
                ?>
                        <option value="<?php echo $post->post_name ?>" <?php selected($instructor, $post->post_name, true)  ?>>
                            <?php echo esc_html(the_title()) ?>
                        </option>
                <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </select>
        </td>
    </tr>
</table>