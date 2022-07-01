<table class="form-table">
    <tr class="row-title">
        <th>Descripción corta</th>
        <td>
            <textarea name="short_instructor" id="short_instructor" cols="46" rows="3">
                <?php echo get_post_meta($object->ID, 'short_instructor', true) ?>
            </textarea>
        </td>
    </tr>
    <tr class="row-title">
        <th class="row-title">Especialidades</th>
        <td>
            <select data-placeholder="Selecciona una especialidad" class="regular-text especialidades-select" multiple name="especialidades[]" id="">Selecciona una especialidad
                <?php
                $seleccionadas = maybe_unserialize(get_post_meta($object->ID, 'especialidades', true));

                $lenguajes = [
                    '1' => 'JavaScript',
                    '2' => 'PHP',
                    '3' => 'Vue JS',
                    '4' => 'Angular',
                    '5' => 'React',
                    '6' => 'Laravel',
                    '7' => 'Wordpress'
                ];
                foreach ($lenguajes as $handle =>  $lenguaje) : ?>
                    <option <?php echo in_array($handle, (array) $seleccionadas) ? 'selected' : '' ?> value="<?php echo $handle ?>"><?php echo $lenguaje ?></option>
                <?php endforeach;
                ?>
            </select>
        </td>
    </tr>
</table>