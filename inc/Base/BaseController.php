<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base;

class BaseController
{
    public $plugin_path;
    public $plugin_name;
    public $plugin_url;
    public $plugin_settings_fields = array();

    function __construct()
    {
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_name =  plugin_basename(dirname(__FILE__, 3)) . '/phemrise_first_plugin.php';
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin_settings_fields = [
            "cpt_manager" => "Custom Post Manager",
            "taxonomies_manager" => "Taxonomies Manager",
            "sidebar_widgets" => "Side Widgets Manager",
            "gallary_manager" => "Gallery Manager",
            "testimonial_manager" => "Testimonials Manager",
            "custom_template_manager" => "Custom Templates Manager",
            "login_system_manager" => "Login System Manager",
            "membership_settings" => "Membership Settings",
            "chat_system_manager" => "Chat System Manager"
        ];
    }
    public function featureActivated($feature)
    {
        $options = get_option('phemrise_plugin');
        return isset($options[$feature]) ? $options[$feature] : false;
    }
}
