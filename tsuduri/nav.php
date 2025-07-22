<nav class="main_nav">
    <div class="header_logo">
        <h1><a href="<?php echo home_url(); ?>">
            <?php the_custom_logo();
            if (!has_custom_logo()) {
            bloginfo('name');
            } ?>
        </a></h1>
        <div class="header_description"><?php bloginfo( 'description' ); ?></div>
    </div>

    <div class="main_nav_inner">
        <div class="main_menu">
            <?php wp_nav_menu('theme_location=navigation'); ?>
        </div>
    </div>

    <!-- menu icon -->
    <div class="burger-menu">
        <div class="line-menu line-half first-line"></div>
        <div class="line-menu"></div>
        <div class="line-menu line-half last-line"></div>
    </div>
</nav>
