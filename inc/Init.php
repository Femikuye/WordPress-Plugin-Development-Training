<?php

/**
 * @package PhemriseFirstPlugin
 */

namespace Inc;

final class Init
{
    /**
     * Store all the classes inside an array
     * @return array full of classes
     */
    public static function get_services()
    {
        return [
            Pages\Dashboard::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Base\Controllers\CustomPostTypeController::class,
            Base\Controllers\TaxonomiesController::class,
            Base\Controllers\WidgetsController::class,
            Base\Controllers\GalleryManagerController::class,
            Base\Controllers\TestimonialController::class,
            Base\Controllers\TemplateManagerController::class,
            Base\Controllers\LoginSystemController::class,
            Base\Controllers\MembershipSettingsController::class,
            Base\Controllers\ChatSystemController::class,

        ];
    }
    /**
     * Loop through the classes, initialize them
     * and call the register method if it exist
     * @return void
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
    /**
     * Initialize the class
     * @param class $class from the services array
     * @return class instance new instance of the class
     */
    private static function instantiate($class)
    {
        $service = new $class;
        return $service;
    }
}
