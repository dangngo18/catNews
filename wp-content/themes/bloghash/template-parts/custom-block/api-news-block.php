<?php

/**
 * Reusing from hero template for API New block.
 *
 * @package     Bloghash
 * @since       1.0.0
 * @author      DangNH
 */


// API endpoint — your crawler plugin’s REST route
$api_url = home_url('/wp-json/news/v1/latest');

// Fetch data from your API
$cached = get_transient('bloghash_api_news_data');
if ($cached) {
    $data = $cached;
} else {
    $response = wp_remote_get($api_url);
    if (!is_wp_error($response)) {
        $data = json_decode(wp_remote_retrieve_body($response), true);
        set_transient('bloghash_api_news_data', $data, HOUR_IN_SECONDS);
    }
}

// Stop if no data
if (empty($data)) {
    echo '<p>No news available.</p>';
    return;
}

foreach ($data as $item) :

    // Post items HTML markup.
    ob_start();

?>
    <div class="swiper-slide">
        <article class="bloghash-article">
            <div class="bloghash-blog-entry-wrapper bloghash-thumb-hero bloghash-thumb-left">
                <div class="post-thumb entry-media thumbnail">
                    <a href="<?php echo esc_url($item['link']); ?>" class="entry-image-link">
                        <?php if (! empty($item['image'])) : ?>
                            <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                        <?php endif; ?>
                    </a>
                </div>
                <div class="bloghash-entry-content-wrapper">
                    <header class="entry-header">
                        <h4 class="entry-title">
                            <a href="<?php echo esc_url($item['link']); ?>" target="_blank">
                                <?php echo esc_html($item['title']); ?>
                            </a>
                        </h4>
                    </header>
                    <p class="entry-summary"><?php echo wp_trim_words(wp_strip_all_tags($item['description']), 25, '...'); ?></p>
                </div>
            </div>
        </article>
    </div>

<?php
    $bloghash_hero_items_html .= ob_get_clean();
endforeach;

// Hero container. {"delay": 8000, "disableOnInteraction": false}

?>
<div class="bloghash-hero-slider bloghash-blog-horizontal">
    <div class="bloghash-horizontal-slider">

        <div class="bloghash-hero-container bloghash-container">
            <div class="bloghash-flex-row">
                <div class="col-xs-12">
                    <div class="bloghash-swiper swiper" data-swiper-options='{
						"spaceBetween": 24,
						"slidesPerView": 1,
						"breakpoints": {
							"0": {
								"spaceBetween": 16
							},
							"768": {
								"spaceBetween": 16
							},
							"1200": {
								"spaceBetween": 24
							}
						},
						"loop": true,
						"autoHeight": true,
						"autoplay": {"delay": 12000, "disableOnInteraction": false},
						"speed": 1000,
						"navigation": {"nextEl": ".hero-next", "prevEl": ".hero-prev"}
					}'>
                        <div class="swiper-wrapper">
                            <?php echo wp_kses($bloghash_hero_items_html, bloghash_get_allowed_html_tags()); ?>
                        </div>
                        <div class="swiper-button-next hero-next"></div>
                        <div class="swiper-button-prev hero-prev"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="bloghash-spinner visible">
            <div></div>
            <div></div>
        </div> -->
    </div>
</div><!-- END .bloghash-hero-slider -->