# marutake-wp-site

This repository contains utilities for automating WordPress interactions. The
`post_to_wp.py` script provides a helper function to publish posts via the
WordPress REST API.

## Usage

1. Set the following environment variables:
   - `WP_URL` – URL of the WordPress site (e.g. `https://example.com`).
   - `WP_USER` – WordPress username.
   - `WP_PASSWORD` – WordPress Application Password.
   You can place these in a `.env` file or set them via your OS. See the Windows
   [documentation](https://learn.microsoft.com/windows/win32/procthread/environment-variables)
   or [macOS Terminal guide](https://support.apple.com/guide/terminal/environment-variables).

2. Run the script directly or import the `post_to_wordpress` function in your
   project:

```bash
python post_to_wp.py "朗読第1回" "本文" --categories 4 --tags 7 --featured-image https://example.com/image.jpg
```

3. Optional CLI arguments:
   - `--categories` – comma-separated list of category IDs. (カテゴリーIDはWordPress管理画面から確認できます)
   - `--tags` – comma-separated list of tag IDs. (タグIDも管理画面で確認可能です)
   - `--featured-image` – URL of the image to upload as the featured image.

The script publishes the post using the provided title and content. Categories
and tags can be specified as comma-separated ID lists. A featured image URL can
also be supplied and will be uploaded automatically. Errors and success
messages are logged for convenience.

## よくあるエラーと対処法

- **401** 認証情報が正しくない可能性があります。ユーザー名とアプリケーションパスワードを再確認してください。
- **403** アクセス権限が不足しています。ユーザーの権限設定を確認してください。
- **404** エンドポイントURLが誤っている可能性があります。サイトのURL設定を確認してください。
