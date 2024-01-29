<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\BannerImagesCallback;

class BannerEffectImagesController extends BaseController
{
    public $subpages = array();
    public $settings;
    public $custom_post_types = array();
    public $callback;
    public function register()
    {
        // if (!$this->featureActivated('banner_images_effect')) return;


        $this->settings = new SettingsApi();
        $this->callback = new BannerImagesCallback();
        $this->setSubPages();

        $this->setSettings();
        $this->setSection();
        $this->setFields();
        add_shortcode("pp_biem", array($this, 'bannerFrontDisplay'));
        $this->settings->addSubPages($this->subpages)->register();
    }
    public function setSubPages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'phemrise_plugin_dashboard',
                'page_title' => 'Phemrise Banner Effect Images ',
                'menu_title' => 'Banner Images',
                'capability' => 'manage_options',
                'menu_slug' => 'phemrise_banner_effect_images',
                'callback' => array($this, 'htmlPage'),
            ],
        ];
    }
    public function setSettings()
    {
        $settings_array = [
            [
                'option_name' => 'phemrise_plugin_biem',
                'option_group' => 'phemrise_plugin_biem_images_settings',
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
                    'id' => 'phemrise_plugin_biem_section',
                    'title' => ' ',
                    'callback' => array($this->callback, 'sectionSetting'),
                    'page' => 'phemrise_banner_effect_images'
                ]
            ];
        $this->settings->setSections($section_params);
    }
    public function setFields()
    {
        $fields = [
            [
                'id' => 'image_id',
                'title' => '',
                'page' => 'phemrise_banner_effect_images',
                'section' => 'phemrise_plugin_biem_section',
                'callback' => array($this->callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'image_id',
                    'option_name' => 'phemrise_plugin_biem'
                ]
            ],
            [
                'id' => 'image_title',
                'title' => 'Image Title',
                'page' => 'phemrise_banner_effect_images',
                'section' => 'phemrise_plugin_biem_section',
                'callback' => array($this->callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'image_title',
                    'option_name' => 'phemrise_plugin_biem'
                ]
            ],
            [
                'id' => 'image_description',
                'title' => 'Image Description',
                'page' => 'phemrise_banner_effect_images',
                'section' => 'phemrise_plugin_biem_section',
                'callback' => array($this->callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'image_description',
                    'option_name' => 'phemrise_plugin_biem'
                ]
            ],
            [
                'id' => 'image',
                'title' => 'Choose Banner Image',
                'page' => 'phemrise_banner_effect_images',
                'section' => 'phemrise_plugin_biem_section',
                'callback' => array($this->callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'image',
                    'option_name' => 'phemrise_plugin_biem'
                ]
            ],
        ];
        $this->settings->setFields($fields);
    }
    public function bannerFrontDisplay()
    {
        $images = get_option('phemrise_plugin_biem');
        $bg = get_option('phemrise_plugin_biem_setter');
        $bg_url = !empty($bg) && isset($bg["image_url"]) ? $bg["image_url"] : null;
        $default_bg = !is_null($bg_url) ? "url($bg_url);" : "#333;";
        $banner_height = !empty($bg) && isset($bg['baner_height']) ? $bg['baner_height'] : 600;
        $items_height = !empty($bg) && isset($bg['items_height']) ? $bg['items_height'] : 300;
        $styles_output = ".phemrise-zoom-wrapper .phemrise-zoom{
            width: 100%;
            height: " . $banner_height . "px;
            background: $default_bg
            position: relative;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        .phemrise-zoom-wrapper .phemrise-items-show{
            height: " . $items_height . "px;
        }
        ";
        $tags_output = '<div class="wrap">
        <div class="phemrise-zoom-wrapper">
            <div class="phemrise-zoom">';
        $zoom_items = "";
        $items_navs = "";
        if (!empty($images)) {
            foreach ($images as $image) {
                $k = 1;
                $bg_url = isset($image["image"]) ? $image["image"] : null;
                $image_bg = !is_null($bg_url) ? "url($bg_url);" : "#333;";
                $styles_output .= "
                .phemrise-item-$k{
                    background:  $image_bg
                    opacity: 0;
                }
                ";
                $zoom_items .= ' <div class="phemrise-item-' . $k . ' phemrise-slide-item"> </div> ';
                $items_navs .= '<div class="phemrise-item-' . $k . '-show phemrise-items-show">
                <h3>' . $image["image_title"] . '</h3><p>' . $image["image_description"] . '</p> </div>';
                $k++;
            }
        }
        $tags_output = $tags_output . $zoom_items . '</div><div class="phemrise-items-nav">' . $items_navs . '</div></div></div>';
        $styles_output = "<style>$styles_output</style>";
        return $styles_output . $tags_output;
    }
    public function htmlPage()
    {
        return require_once("$this->plugin_path/templates/admin/banner_effect_images_manager.php");
    }
}
