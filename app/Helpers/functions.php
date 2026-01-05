<?php
use App\Models\Option; 

if (!function_exists('get_option')) {
    function get_option($key, $default = null) {
        // Sử dụng static để tránh truy vấn DB nhiều lần trong cùng 1 request
        static $settings = [];
        if (empty($settings)) {
            $settings = Option::pluck('opt_value', 'opt_key')->toArray();
        }

        return $settings[$key] ?? $default;
    }
}