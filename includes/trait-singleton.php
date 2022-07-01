<?php

trait Htwp_singleton
{

    final public static function htwp_get_instance()
    {
        static  $instance = [];

        $called_class = get_called_class();

        if (!isset($instance[$called_class])) :
            $instance[$called_class] = new $called_class();
        endif;

        return $instance[$called_class];
    }
}
