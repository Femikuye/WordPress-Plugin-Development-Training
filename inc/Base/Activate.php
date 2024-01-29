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

        $default = array();

        if (!get_option("phemrise_plugin")) {
            update_option('phemrise_plugin', $default);
        }
        if (!get_option('phemrise_plugin_cpt')) {
            update_option('phemrise_plugin_cpt', $default);
        }
        if (!get_option('phemrise_plugin_biem')) {
            update_option('phemrise_plugin_biem', $default);
        }
        if (!get_option('phemrise_plugin_biem_setter')) {
            update_option('phemrise_plugin_biem_setter', $default);
        }
    }
}
