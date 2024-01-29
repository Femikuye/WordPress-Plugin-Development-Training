<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Base\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\CptCallbacks;

class CustomPostTypeController extends BaseController
{
    public $subpages = array();
    public $settings;
    public $custom_post_types = array();
    public $cpt_callback;
    public function register()
    {
        if (!$this->featureActivated('cpt_manager')) return;


        $this->settings = new SettingsApi();
        $this->cpt_callback = new CptCallbacks();
        $this->setSubPages();

        $this->setSettings();
        $this->setSection();
        $this->setFields();

        $this->settings->addSubPages($this->subpages)->register();


        // $this->setCustomPostTypes();

        // if (!empty($this->custom_post_types))
        add_action("init", array($this, 'registerCustomPostType'));
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
    public function setCustomPostTypes()
    {
        $this->custom_post_types[] = [
            'post_type' => 'phemrise_courses',
            'name' => 'Courses',
            'singular_name' => 'Course',
            'public' => true,
            'has_archive' => true
        ];
    }
    public function registerCustomPostType()
    {
        $posts = get_option('phemrise_plugin_cpt');
        if (empty($posts)) return;
        foreach ($posts as $post) {
            register_post_type(
                $post['post_type_id'],
                array(
                    'labels' => array(
                        'name' =>  $post['name'],
                        'singular_name' =>  $post['single_name']
                    ),
                    'public' =>  isset($post['public_status']) ? ($post['public_status'] ?: false) : false,
                    'has_archive' =>  isset($post['has_archive']) ? ($post['has_archive'] ?: false) : false,
                    'menu_name'             => $post['single_name'] . ' Menu',
                    'name_admin_bar'        => $post['single_name'] . ' Admin',
                    'archives'              => $post['single_name'] . ' Archives',
                    'attributes'            => $post['single_name'] . ' Attributes',
                    'parent_item_colon'     => 'Parent ' . $post['single_name'],
                    'all_items'             => 'All ' . $post['single_name'],
                    'add_new_item'          => 'Add New ' . $post['single_name'],
                    'add_new'               => 'Add New',
                    'new_item'              => 'New ' . $post['single_name'],
                    'edit_item'             => 'Edit ' . $post['single_name'],
                    'update_item'           => 'Update ' . $post['single_name'],
                    'view_item'             => 'View ' . $post['single_name'],
                    'view_items'            => 'View ' . $post['name'],
                    'search_items'          => 'Search ' . $post['name'],
                    'not_found'             => 'No ' . $post['single_name'] . ' Found',
                    'not_found_in_trash'    => 'No ' . $post['single_name'] . ' Found In Trash',
                    'featured_image'        => 'Featured Image',
                    'set_featured_image'    => 'Set Featured Image',
                    'remove_featured_image' => 'Remove Featured Image',
                    'use_featured_image'    => 'Use Featured Image',
                    'insert_into_item'      => 'Insert Into ' . $post['single_name'],
                    'uploaded_to_this_item' => 'Upload to this ' . $post['single_name'],
                    'items_list'            => $post['single_name'] . ' List',
                    'items_list_navigation' => $post['single_name'] . ' List Navigation',
                    'filter_items_list'     => 'Filter ' . $post['name'] . ' List',
                    'label'                 => $post['single_name'],
                    'description'           => $post['single_name'] . ' Custom Post Type',
                    'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'), //
                    'taxonomies'            => array('category', 'post_tag'),
                    'hierarchical'          => false,
                    'show_ui'               => true,
                    'show_in_menu'          => true,
                    'menu_position'         => 5,
                    'show_in_admin_bar'     => true,
                    'show_in_nav_menus'     => true,
                    'can_export'            => true,
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'capability_type'       => 'post'
                )
            );
        }
    }
    public function setSettings()
    {
        $settings_array = [
            [
                'option_name' => 'phemrise_plugin_cpt',
                'option_group' => 'phemrise_plugin_cpt_settings',
                'callback' => array($this->cpt_callback, 'cptSettings')
            ]
        ];
        $this->settings->setSettings($settings_array);
    }
    public function setSection()
    {
        $section_params =
            [
                [
                    'id' => 'phemrise_plugin_cpt_section',
                    'title' => 'Custom Post Type Settings',
                    'callback' => array($this->cpt_callback, 'sectionSetting'),
                    'page' => 'phemrise_cpt'
                ]
            ];
        $this->settings->setSections($section_params);
    }
    public function setFields()
    {
        $fields = [
            [
                'id' => 'post_type_id',
                'title' => 'Post Id',
                'page' => 'phemrise_cpt',
                'section' => 'phemrise_plugin_cpt_section',
                'callback' => array($this->cpt_callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'post_type_id',
                    'option_name' => 'phemrise_plugin_cpt'
                ]
            ],
            [
                'id' => 'name',
                'title' => 'Name',
                'page' => 'phemrise_cpt',
                'section' => 'phemrise_plugin_cpt_section',
                'callback' => array($this->cpt_callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'name',
                    'option_name' => 'phemrise_plugin_cpt'
                ]
            ],
            [
                'id' => 'single_name',
                'title' => 'Singular Name',
                'page' => 'phemrise_cpt',
                'section' => 'phemrise_plugin_cpt_section',
                'callback' => array($this->cpt_callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'single_name',
                    'option_name' => 'phemrise_plugin_cpt'
                ]
            ],
            [
                'id' => 'public_status',
                'title' => 'Public Status',
                'page' => 'phemrise_cpt',
                'section' => 'phemrise_plugin_cpt_section',
                'callback' => array($this->cpt_callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'public_status',
                    'option_name' => 'phemrise_plugin_cpt'
                ]
            ],
            [
                'id' => 'has_archive',
                'title' => 'Has Archive',
                'page' => 'phemrise_cpt',
                'section' => 'phemrise_plugin_cpt_section',
                'callback' => array($this->cpt_callback, 'fieldSettings'),
                'args' => [
                    'label_for' => 'has_archive',
                    'option_name' => 'phemrise_plugin_cpt'
                ]
            ]
        ];
        $this->settings->setFields($fields);
    }
    public function htmlPage()
    {
        return require_once("$this->plugin_path/templates/admin/custom_post_type.php");
    }
}
