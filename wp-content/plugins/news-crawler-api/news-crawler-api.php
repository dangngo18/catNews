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

function bloghash_api_news_shortcode()
{
    ob_start();
    get_template_part('template-parts/custom-block/api-news-block');
    return ob_get_clean();
}
add_shortcode('api_news_block', 'bloghash_api_news_shortcode');

function nc_display_latest_news()
{
    $news = nc_get_news_data();

    $html = '<div class="news-container" style="max-width: 800px; margin: 20px auto;">';
    $html .= '<h4 style="margin-bottom: 20px;">Latest News</h4>';
    $html .= '<ul style="list-style: none; padding: 0;">';

    foreach ($news as $item) {
        $html .= '<li style="margin-bottom: 15px; padding: 10px; border-bottom: 1px solid #eee;">';
        $html .= '<h5 style="margin: 0 0 5px 0;"><a href="' . esc_url($item['link']) . '" target="_blank" rel="noopener">' . esc_html($item['title']) . '</a></h5>';
        $html .= '<p class="entry-summary">' . wp_trim_words(wp_strip_all_tags($item['description']), 25, '...') . '</p>';
        $html .= '<p class="entry-meta"><time datetime="' . esc_attr($item['pubDate']) . '">' . esc_html($item['pubDate']) . '</time></p>';
        $html .= '</li>';
    }

    $html .= '</ul></div>';
    return $html;
}
add_shortcode('api_news_block_as_list', 'nc_display_latest_news');
