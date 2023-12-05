<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Pages;


use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
    public $settings;
    public $pages = array();
    public $subpages = array();

    public $manager;

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->manager = new ManagerCallbacks();
        $this->setPages();
        $this->setSubPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => 'Phemrise Plugin Dashboard',
                'menu_title' => 'Phemrise Dashboard',
                'capability' => 'manage_options',
                'menu_slug' => 'phemrise_plugin_dashboard',
                'callback' => array($this, 'dashboardHtml'),
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];
    }
    public function setSubPages()
    {
    }

    public function setSettings()
    {
        $args = [
            [
                "option_group" => 'phemrise_plugin_settings',
                "option_name" => 'phemrise_plugin',
                "callback" => array($this->manager, 'phemrisePluginSettings')
            ]
        ];
        // foreach ($this->plugin_settings_fields as $field_name => $title) {
        //     $args[] =  [
        //         "option_group" => 'phemrise_plugin_settings',
        //         "option_name" => $field_name,
        //         "callback" => array($this->manager, 'phemrisePluginSettings')
        //     ];
        // }
        $this->settings->setSettings($args);
    }
    public function setSections()
    {
        $args = [
            [
                "id" => 'phemrise_plugin_features_setting',
                "title" => 'Features Settings',
                "callback" => array($this->manager, 'phemrisePluginFeaturesSettings'),
                "page" => 'phemrise_plugin_dashboard'
            ]
        ];
        $this->settings->setSections($args);
    }
    public function setFields()
    {
        $args = array();
        foreach ($this->plugin_settings_fields as $field_name => $title) {
            $args[] =  [
                "id" => $field_name,
                "title" => $title,
                "callback" => array($this->manager, 'checkboxField'),
                "page" => 'phemrise_plugin_dashboard',
                "section" => 'phemrise_plugin_features_setting',
                "args" => array(
                    'option_name' => 'phemrise_plugin',
                    'label_for' => $field_name,
                    'class' => 'pp_ui_toggle',
                )
            ];
        }
        $this->settings->setFields($args);
    }
    public function dashboardHtml()
    {
        return require_once("$this->plugin_path/templates/admin/admin.php");
    }
}
