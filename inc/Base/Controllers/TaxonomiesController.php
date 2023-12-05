<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class TaxonomiesController extends BaseController
{
    public $subpages = array();
    public $settings;
    public function register()
    {
        if (!$this->featureActivated('taxonomies_manager')) return;

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
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomies',
                'capability' => 'manage_options',
                'menu_slug' => 'phemrise_taxonomies',
                'callback' => array($this, 'htmlPage'),
            ],
        ];
    }
    public function htmlPage()
    {
        return require_once("$this->plugin_path/templates/admin/taxonomies.php");
    }
}
