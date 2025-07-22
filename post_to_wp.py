import os
import logging
from typing import Any, Iterable, Optional, Tuple

import requests

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)


def get_env_variable(name: str) -> str:
    value = os.getenv(name)
    if not value:
        raise EnvironmentError(f"Environment variable {name} is not set")
    return value


def _upload_featured_image(
    wp_url: str, auth: Tuple[str, str], image_url: str
) -> Optional[int]:
    """Upload an image to WordPress and return the attachment ID."""

    try:
        resp = requests.get(image_url, timeout=10)
        resp.raise_for_status()
    except requests.RequestException as exc:
        logger.error("Failed to download featured image: %s", exc)
        return None

    filename = os.path.basename(image_url) or "featured_image"
    media_endpoint = f"{wp_url.rstrip('/')}/wp-json/wp/v2/media"
    headers = {
        "Content-Disposition": f'attachment; filename="{filename}"',
        "Content-Type": resp.headers.get("Content-Type", "application/octet-stream"),
    }

    try:
        upload = requests.post(
            media_endpoint,
            data=resp.content,
            headers=headers,
            auth=auth,
            timeout=10,
        )
        upload.raise_for_status()
    except requests.RequestException as exc:
        logger.error("Failed to upload featured image to WordPress: %s", exc)
        return None

    try:
        return upload.json().get("id")
    except ValueError:
        logger.error("Invalid JSON response when uploading featured image")
        return None


def _log_http_error(status_code: int) -> None:
    if status_code == 401:
        logger.error("認証に失敗しました。ユーザー名とパスワードを確認してください。")
    elif status_code == 403:
        logger.error("アクセスが拒否されました。権限を確認してください。")
    elif status_code == 404:
        logger.error("APIエンドポイントが見つかりません。URLを確認してください。")
    elif 500 <= status_code < 600:
        logger.error("サーバーエラーです。WordPressサイトの状態を確認してください。")
    else:
        logger.error("HTTP error %s", status_code)


def post_to_wordpress(
    title: str,
    content: str,
    *,
    categories: Optional[Iterable[int]] = None,
    tags: Optional[Iterable[int]] = None,
    featured_image_url: Optional[str] = None,
) -> Any:
    """Post an article to WordPress via REST API.

    Parameters
    ----------
    title : str
        Title of the WordPress post.
    content : str
        Body content of the WordPress post.

    Returns
    -------
    Any
        JSON response from the WordPress API if successful.
    """
    wp_url = get_env_variable("WP_URL")
    wp_user = get_env_variable("WP_USER")
    wp_password = get_env_variable("WP_PASSWORD")

    endpoint = f"{wp_url.rstrip('/')}/wp-json/wp/v2/posts"

    headers = {
        "Content-Type": "application/json",
    }

    data = {
        "title": title,
        "content": content,
        "status": "publish",
    }

    if categories:
        data["categories"] = list(categories)
    if tags:
        data["tags"] = list(tags)

    auth = (wp_user, wp_password)
    if featured_image_url:
        image_id = _upload_featured_image(wp_url, auth, featured_image_url)
        if image_id:
            data["featured_media"] = image_id

    try:
        response = requests.post(
            endpoint,
            json=data,
            headers=headers,
            auth=auth,
            timeout=10,
        )
        response.raise_for_status()
    except requests.HTTPError as e:
        if e.response is not None:
            _log_http_error(e.response.status_code)
        else:
            logger.error("HTTP error without response: %s", e)
        raise
    except requests.RequestException as e:
        logger.error("Failed to post to WordPress: %s", e)
        raise

    try:
        json_response = response.json()
    except ValueError:
        logger.error("Invalid JSON response from WordPress")
        raise

    logger.info("Post created successfully: %s", json_response.get("link"))
    return json_response


if __name__ == "__main__":
    import argparse

    parser = argparse.ArgumentParser(description="Publish a post to WordPress.")
    parser.add_argument("title", help="Post title")
    parser.add_argument("content", help="Post content")
    parser.add_argument(
        "--categories",
        help="Comma-separated list of category IDs",
        default="",
    )
    parser.add_argument(
        "--tags",
        help="Comma-separated list of tag IDs",
        default="",
    )
    parser.add_argument(
        "--featured-image",
        help="URL of the featured image",
        dest="featured_image",
    )

    args = parser.parse_args()

    categories = (
        [int(c.strip()) for c in args.categories.split(",") if c.strip()]
        if args.categories
        else None
    )
    tags = (
        [int(t.strip()) for t in args.tags.split(",") if t.strip()]
        if args.tags
        else None
    )

    post_to_wordpress(
        args.title,
        args.content,
        categories=categories,
        tags=tags,
        featured_image_url=args.featured_image,
    )
