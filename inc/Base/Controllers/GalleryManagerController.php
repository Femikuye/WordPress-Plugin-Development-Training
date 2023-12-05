<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class GalleryManagerController extends BaseController
{
    public $subpages = array();
    public $settings;
    public function register()
    {
        if (!$this->featureActivated('gallary_manager')) return;

        $this->settings = new SettingsApi();
        $this->setSubPages();
        $this->settings->addSubPages($this->subpages)->register();
        // add_action("init", array($this, 'activate'));
    }
    public function setSubPages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'phemrise_plugin_dashboard',
                'page_title' => 'Phemrise Gallery Manager',
                'menu_title' => 'Gallery',
                'capability' => 'manage_options',
                'menu_slug' => 'phemrise_gallery',
                'callback' => array($this, 'htmlPage'),
            ],
        ];
    }
    public function htmlPage()
    {
        return require_once("$this->plugin_path/templates/admin/gallery.php");
    }
}
