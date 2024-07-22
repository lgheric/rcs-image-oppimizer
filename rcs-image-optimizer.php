<?php
/*
Plugin Name: RCS Image Optimizer
Description: A simple image optimization plugin that compresses images and enables lazy loading.
Version: 1.0.0
Author: Robert South
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

define('RCS_IMAGE_OPTIMIZER_VERSION', '1.0.0');
define('RCS_IMAGE_OPTIMIZER_PATH', plugin_dir_path(__FILE__));

// 自动加载类
spl_autoload_register(function ($class) {
    $prefix = 'RCS_Image_Optimizer\\';
    $base_dir = RCS_IMAGE_OPTIMIZER_PATH . 'includes/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . 'class-' . str_replace('_', '-', strtolower($relative_class)) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

function rcs_image_optimizer_init()
{
    $image_optimizer = new \RCS_Image_Optimizer\Image_Optimizer();
    $lazy_load = new \RCS_Image_Optimizer\Lazy_Load();
}

add_action('plugins_loaded', 'rcs_image_optimizer_init');
