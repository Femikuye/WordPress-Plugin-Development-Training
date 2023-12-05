<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard()
    {
        return require_once("$this->plugin_path/templates/admin/admin.php");
    }
    public function adminCpt()
    {
        return require_once("$this->plugin_path/templates/admin/custom_post_type.php");
    }
    public function adminTaxonimies()
    {
        return require_once("$this->plugin_path/templates/admin/taxonomies.php");
    }
    public function adminWidgets()
    {
        return require_once("$this->plugin_path/templates/admin/widgets.php");
    }
    public function adminGallery()
    {
        return require_once("$this->plugin_path/templates/admin/widgets.php");
    }
    public function adminTestimonial()
    {
        return require_once("$this->plugin_path/templates/admin/widgets.php");
    }
}
