<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();

        if (get_option("phemrise_plugin")) {
            return;
        }
        $default = array();
        update_option('phemrise_plugin', $default);
    }
}
