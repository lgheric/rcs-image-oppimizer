<?php
/*
Plugin Name: RCS Image Optimizer
Description: A simple image optimization plugin that compresses images and enables lazy loading.
Version: 1.0
Author: Robert South
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin path
define('IMAGE_OPTIMIZER_PATH', plugin_dir_path(__FILE__));

// Include main classes
require_once IMAGE_OPTIMIZER_PATH . 'includes/class-image-optimizer.php';
require_once IMAGE_OPTIMIZER_PATH . 'includes/class-lazy-load.php';

// Initialize plugin
function image_optimizer_init() {
    $image_optimizer = new Image_Optimizer();
    $lazy_load = new Lazy_Load();
}
add_action('plugins_loaded', 'image_optimizer_init');
