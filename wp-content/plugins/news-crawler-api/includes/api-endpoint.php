<?php
if (!defined('ABSPATH')) exit;

add_action('rest_api_init', function () {
    register_rest_route('news/v1', '/latest', [
        'methods' => 'GET',
        'callback' => 'nc_get_news_data',
        'permission_callback' => '__return_true', //public endpoint
    ]);
});
