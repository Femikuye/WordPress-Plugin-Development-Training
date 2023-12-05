<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class CustomPostTypeController extends BaseController
{
    public $subpages = array();
    public $settings;
    public function register()
    {
        if (!$this->featureActivated('cpt_manager')) return;


        $this->settings = new SettingsApi();
        $this->setSubPages();

        $this->settings->addSubPages($this->subpages)->register();
        add_action("init", array($this, 'activate'));
    }
    public function setSubPages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'phemrise_plugin_dashboard',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'phemrise_cpt',
                'callback' => array($this, 'htmlPage'),
            ],
        ];
    }
    public function activate()
    {
        register_post_type(
            'phemrise_posts',
            array(
                'labels' => array(
                    'name' => 'Products',
                    'singular_name' => 'Product'
                ),
                'public' => true,
                'has_archive' => true
            )
        );
    }
    public function htmlPage()
    {
        return require_once("$this->plugin_path/templates/admin/custom_post_type.php");
    }
}
