<?php
/**
 * Plugin Name: News Crawler API
 * Description: Crawls data from an external news website and exposes it via REST API.
 * Version: 1.0
 * Author: DangNH
 */

if (!defined('ABSPATH')) exit; // Prevent direct access

// Include dependencies
require_once __DIR__ . '/includes/news-crawler.php';
require_once __DIR__ . '/includes/api-endpoint.php';

function bloghash_api_news_shortcode() {
    ob_start();
    get_template_part('template-parts/custom-block/api-news-block');
    return ob_get_clean();
}
add_shortcode('api_news_block', 'bloghash_api_news_shortcode');