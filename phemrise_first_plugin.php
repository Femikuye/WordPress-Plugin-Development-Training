<?php

/**
 * @package PhemriseFirstPlugin
 */
/*
 Plugin Name: Phemrise Plugin 001
 Plugin URI: https://phemrise.com
 Description: Phemrise First Plugin
 Author: Phemrise
 Version: 1.0.0
 Author URI: https://phemrise.com
 License: GPLv2 or later
 Text Domain: Phemrise First Plugin
 */
/*
Licence Text Here
*/

defined('ABSPATH') or die("No direct access allowed");

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}


//  Activation
function activate_phemrise_first_plugin()
{
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_phemrise_first_plugin');

// Deactivation
function deactivate_phemrise_first_plugin()
{
    Inc\Base\Deactivate::deactivate();
}
register_activation_hook(__FILE__, 'deactivate_phemrise_first_plugin');


if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}


//     function custom_post_type()
//     {
//         register_post_type(
//             'book',
//             ['public' => true, 'label' => "Books"]
//         );
//     }
