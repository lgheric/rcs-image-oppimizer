<?php

class Lazy_Load {
    
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_filter('the_content', array($this, 'add_lazy_load_to_images'));
    }

    public function enqueue_scripts() {
        wp_enqueue_script('lazy-load', plugins_url('../assets/js/lazy-load.js', __FILE__), array(), '1.0', true);
    }

    public function add_lazy_load_to_images($content) {
        if (!is_singular()) {
            return $content;
        }

        $content = preg_replace('/<img(.*?)src=/', '<img$1data-src=', $content);
        $content = preg_replace('/<img(.*?)class="/', '<img$1class="lazy-load ', $content);
        
        return $content;
    }
}
