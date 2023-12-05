<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
    public function phemrisePluginSettings($input)
    {
        $output = array();
        // return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
        // return (isset($input) ? true : false);
        foreach ($this->plugin_settings_fields as $k => $value) {
            $output[$k] = isset($input[$k]) ? true : false;
        }
        return $output;
    }
    public function phemrisePluginFeaturesSettings()
    {
        echo 'Activate Or Deactivate Phemrise Plugin Features';
    }
    public function checkboxField($args)
    {
        if (!isset($args)) return;
        $name = $args["label_for"];
        $classes = $args["class"];
        $option_name = $args["option_name"];
        $checkbox = get_option($option_name);
        $checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;
        // $checkbox = esc_attr(get_option($option_name));
        echo '<input type="checkbox" class="' . $classes . '" name="' . $option_name . '[' . $name . ']" 
        value="1" ' . ($checked ? 'checked' : '') . '>';
    }
    // public function phemriseFirstName()
    // {
    //     $value = esc_attr(get_option('first_name'));
    //     echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your first name">';
    // }
}
