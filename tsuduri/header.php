<!DOCTYPE html>
<html lang="ja">

    <?php if (is_single()) { ?>
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <?php } else { ?>
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
    <?php } ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Web designer Necofly">
    <meta name="format-detection" content="telephone=no">
    <link rel="canonical" href="index.php">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php page_description(); ?>

    <!--ogp-->
    <meta property='og:locale' content='ja_JP'>
    <meta property='og:site_name' content='<?php bloginfo('name'); ?>'>
    <?php
        if (is_single() || is_page()){
            if(have_posts()): while(have_posts()): the_post();
            echo '<meta property="og:title" content="'; the_title(); echo '">';echo "\n";
            echo '<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";
            echo '<meta property="og:type" content="article">';echo "\n";
            endwhile; endif;
        } else {
            echo '<meta property="og:title" content="'; bloginfo('name'); echo '">';echo "\n";
            echo '<meta property="og:url" content="'; bloginfo('url'); echo '">';echo "\n";
            echo '<meta property="og:type" content="website">';echo "\n";
        }
        $str = $post->post_content;
        $searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
        if (is_single()){
            if (has_post_thumbnail()){
            $image_id = get_post_thumbnail_id();
            $image = wp_get_attachment_image_src( $image_id, 'full');
            echo '<meta property="og:image" content="'.$image[0].'">';echo "\n";
            } else if ( preg_match( $searchPattern, $str, $imgurl )){
            echo '<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
            } else {
            ogpImg();
            echo "\n";
            }
        } else {
            ogpImg();
            echo "\n";
        }
    ?>
    <meta name="twitter:card" content="summary_large_image">
    <!--ogp end-->

    <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+JP" rel="stylesheet">
    <link href="https://fonts.googleapis.com/earlyaccess/sawarabimincho.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo ('stylesheet_url'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/mobile.css">

    <?php wp_deregister_script('jquery'); ?>
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery1.12.0.min.js" defer></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/script.js" defer></script>

    <?php head_text(); ?>
    <?php wp_head(); ?>
</head>

<body>
