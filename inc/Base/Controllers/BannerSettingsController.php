<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\BannerSettingsCallback;

class BannerSettingsController extends BaseController
{
    public $subpages = array();
    public $settings;
    public $custom_post_types = array();
    public $callback;
    public function register()
    {
        // if (!$this->featureActivated('banner_images_effect')) return;


        $this->settings = new SettingsApi();
        $this->callback = new BannerSettingsCallback();
        $this->setSubPages();

        $this->setSettings();
        $this->setSection();
        $this->setFields();
        $this->settings->addSubPages($this->subpages)->register();
    }
    public function setSubPages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'phemrise_plugin_dashboard',
                'page_title' => 'Phemrise Banner Settings',
                'menu_title' => 'Banner Settings',
                'capability' => 'manage_options',
                'menu_slug' => 'phemrise_banner_effect_settings',
                'callback' => array($this, 'htmlPage'),
            ],
        ];
    }
    public function setSettings()
    {
        $settings_array = [
            [
                'option_name' => 'phemrise_plugin_biem_setter',
                'option_group' => 'phemrise_plugin_biem_settings',
                'callback' => array($this->callback, 'settings')
            ]
        ];
        $this->settings->setSettings($settings_array);
    }
    public function setSection()
    {
        $section_params =
            [
                [
                    'id' => 'phemrise_plugin_biem_setter_section',
                    'title' => ' ',
                    'callback' => array($this->callback, 'sectionSetting'),
                    'page' => 'phemrise_banner_effect_settings'
                ]
            ];
        $this->settings->setSections($section_params);
    }
    public function setFields()
    {
        $fields = [
            [
                'id' => 'image_url',
                'title' => 'Image',
                'page' => 'phemrise_banner_effect_settings',
                'section' => 'phemrise_plugin_biem_setter_section',
                'callback' => array($this->callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'image_url',
                ]
            ],
            [
                'id' => 'overlay_text',
                'title' => 'Overlay Text',
                'page' => 'phemrise_banner_effect_settings',
                'section' => 'phemrise_plugin_biem_setter_section',
                'callback' => array($this->callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'overlay_text',
                ]
            ],
            [
                'id' => 'baner_height',
                'title' => 'Banner Height (px)',
                'page' => 'phemrise_banner_effect_settings',
                'section' => 'phemrise_plugin_biem_setter_section',
                'callback' => array($this->callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'baner_height',
                ]
            ],
            [
                'id' => 'items_height',
                'title' => 'Banner Items Height (px)',
                'page' => 'phemrise_banner_effect_settings',
                'section' => 'phemrise_plugin_biem_setter_section',
                'callback' => array($this->callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'items_height',
                ]
            ],
        ];
        $this->settings->setFields($fields);
    }
    public function htmlPage()
    {
        return require_once("$this->plugin_path/templates/admin/banner_effect_settings.php");
    }
}
