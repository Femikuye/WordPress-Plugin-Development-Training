<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class ChatSystemController extends BaseController
{
    public $subpages = array();
    public $settings;
    public function register()
    {
        $this->settings = new SettingsApi();
        $this->setSubPages();

        if (!$this->featureActivated('chat_system_manager')) return;

        $this->settings->addSubPages($this->subpages)->register();
        // add_action("init", array($this, 'activate'));
    }
    public function setSubPages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'phemrise_plugin_dashboard',
                'page_title' => 'Chat System Manager',
                'menu_title' => 'Chat Settings',
                'capability' => 'manage_options',
                'menu_slug' => 'phemrise_chat_manager',
                'callback' => array($this, 'htmlPage'),
            ],
        ];
    }
    public function htmlPage()
    {
        return require_once("$this->plugin_path/templates/admin/chat_manager.php");
    }
}
