<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class SettingsLinks extends BaseController
{
    public function register()
    {
        add_filter("plugin_action_links_" . $this->plugin_name, array($this, 'settings__link'));
    }
    function settings__link($links)
    {
        // Add custom settings link
        $settings_link = '<a href="admin.php?page=phemrise_plugin_dashboard">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}
