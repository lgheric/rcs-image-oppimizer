<?php

class Image_Optimizer {
    
    public function __construct() {
        add_filter('wp_generate_attachment_metadata', array($this, 'optimize_image'), 10, 2);
    }

    public function optimize_image($metadata, $attachment_id) {
        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['basedir'] . '/' . $metadata['file'];
        
        $this->compress_image($file_path);
        
        return $metadata;
    }

    private function compress_image($file_path) {
        if (extension_loaded('gd')) {
            $image = imagecreatefromstring(file_get_contents($file_path));
            if ($image !== false) {
                imagejpeg($image, $file_path, 75); // Compress image to 75% quality
                imagedestroy($image);
            }
        }
    }
}
