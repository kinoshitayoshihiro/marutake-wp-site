# marutake-wp-site

This repository contains utilities for automating WordPress interactions. The
`post_to_wp.py` script provides a helper function to publish posts via the
WordPress REST API.

## Usage

1. Set the following environment variables:
   - `WP_URL` – URL of the WordPress site (e.g. `https://example.com`).
   - `WP_USER` – WordPress username.
   - `WP_PASSWORD` – WordPress Application Password.

2. Run the script directly or import the `post_to_wordpress` function in your
   project:

```bash
python post_to_wp.py "Post Title" "Body content" \
  --categories 1,2 --tags 3,4 \
  --featured-image https://example.com/image.jpg
```

The script publishes the post using the provided title and content. Categories
and tags can be specified as comma-separated ID lists. A featured image URL can
also be supplied and will be uploaded automatically. Errors and success
messages are logged for convenience.
