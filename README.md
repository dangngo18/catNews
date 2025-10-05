
# catNews

**catNews** is a WordPress project that crawls news data from external news websites and makes it available via a custom REST API endpoint, integrating with a custom block in the WordPress theme for displaying the latest headlines in a user-friendly way.

## Features

- **News Aggregator Plugin**: Crawls articles from external RSS feeds (currently configured for `vnexpress.net`) and exposes them via a REST API for your WordPress site.
- **REST API Endpoint**: Provides a public endpoint (`/wp-json/news/v1/latest`) that delivers the latest crawled news for frontend consumption or integration.
- **Shortcode and Custom Block**: Includes a shortcode and a custom theme block (`api-news-block.php`) for easy display of aggregated news headlines in your WordPress pages or posts.
- **Caching**: Uses WordPress transients to cache news data for efficient performance.
- **Separation of Concerns**: Core crawling and API logic is implemented as a WordPress plugin; frontend display handled through a theme template-part.

## Repository Structure

```
catNews/
├── .vscode/
├── wp-content/
│   ├── plugins/
│   │   └── news-crawler-api/
│   │       ├── news-crawler-api.php       # Main plugin file
│   │       └── includes/
│   │            ├── news-crawler.php      # Logic for crawling RSS news data
│   │            └── api-endpoint.php      # Registers REST API endpoint
│   └── themes/
│       └── bloghash/
│           └── template-parts/
│               └── custom-block/
│                   └── api-news-block.php # Custom theme block for API news
├── .gitignore
├── README.md
└── index2.html
```

## Installation

1. **Clone the repository** to your WordPress installation:
    ```bash
    git clone https://github.com/dangngo18/catNews.git
    ```
2. **Activate the Plugin:**
    - Copy the `wp-content/plugins/news-crawler-api` directory into your site's `wp-content/plugins/`.
    - Activate the *News Crawler API* plugin from your WordPress admin dashboard.

3. **Theme Integration (Optional):**
    - For full integration, ensure your theme supports the custom block in `wp-content/themes/bloghash/template-parts/custom-block/api-news-block.php`.
    - Use the `[api_news_block]` shortcode in your pages to display news.

## Usage

- **API Endpoint**:  
  Access retrieved news in JSON at:  
  ```
  https://<your-domain>/wp-json/news/v1/latest
  ```

- **Shortcode**:  
  Include the following in your post or page:  
  ```
  [api_news_block]
  ```

- **Custom Block**:  
  The theme part (`api-news-block.php`) pulls news from the REST API and displays it with caching.

## Customizing

- To crawl a different news source, update the `$feed_url` in `news-crawler.php`.
- Extend frontend templates as you wish in your theme.

## Tech Stack

- **WordPress** (plugin and theme integration)
- **PHP** (crawling, REST API)
- **HTML** (frontend templates)

## Author

- DangNH
