<?php
if (!defined('ABSPATH')) exit;

function nc_get_news_data()
{
    // Example: crawl from a public news RSS feed
    $feed_url = 'https://vnexpress.net/rss/tin-noi-bat.rss';

    $response = wp_remote_get($feed_url);

    if (is_wp_error($response)) {
        return ['error' => "Failed to fetch news"];
    }

    $body = wp_remote_retrieve_body($response);

    $xml = simplexml_load_string($body, "SimpleXMLElement", LIBXML_NOCDATA);

    $items = [];

    foreach ($xml->channel->item as $item) {
        $items[] = [
            "title" => (string) $item->title,
            "link" => (string) $item->link,
            "description" => (string) $item->description,
            "pubDate" => (string) $item->pubDate,
            "image" => (string) "https://s1.vnecdn.net/vnexpress/restruct/i/v9715/logos/114x114.png",
        ];
    }

    return $items;
}
