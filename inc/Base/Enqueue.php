<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));
        add_action('wp_enqueue_scripts', array($this, 'ui_enqueue'));
    }
    public function admin_enqueue()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_media();
        wp_enqueue_style('mypluginstyle', $this->plugin_url . 'assets/styles.css');
        wp_enqueue_script('mypluginscript', $this->plugin_url . 'assets/script.js');
    }
    function ui_enqueue()
    {
        // wp_enqueue_script('media-upload');
        wp_enqueue_media();
        wp_enqueue_style('mypluginstyle', $this->plugin_url . 'assets/front/styles.css');
        wp_enqueue_script('mypluginscript', $this->plugin_url . 'assets/front/script.js');
    }
}
