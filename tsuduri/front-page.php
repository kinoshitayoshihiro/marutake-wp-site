<?php get_header(); ?>

<!-- ==========================================================
    nav
===============================================================-->

<?php get_template_part('nav'); ?>



<!-- ==========================================================
    header
===============================================================-->

<header class="header_img">
    <div class="header_inner" <?php headerBG(); ?>></div>
</header>

<article class="site_copy">
    <div class="wrap">
        <?php
            if(have_posts()):
            while(have_posts()):
            the_post();
        ?>
        <h2><img src="<?php echo get_template_directory_uri(); ?>/images/h2icon.svg" class="h2_icon" alt=""><span><?php the_title(); ?></span></h2>
        <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </div>
</article>


<!-- ==========================================================
    books
===============================================================-->

<article class="book_list">
    <div class="b_l_inner">

        <h3>更新作品</h3>

        <section>
            <ul>

                <?php
                    $temp = $wp_query;
                    $wp_query = null;
                    $wp_query = new WP_Query();
                    $wp_query->query('post_type=post' . '&posts_per_page=3' . '&tag=update' . '&paged=' . $paged);
                ?>
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                <li>
                    <a href="<?php the_permalink(); ?>">
                        <dl>
                            <dt>
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                }else {
                                    defaultImg();
                                } ?>
                            </dt>
                            <dd>
                                <span class="novel_data"><?php echo get_the_date('Y/m/d'); ?></span>
                                <h4><?php the_title(); ?></h4>
                                <?php echo get_the_excerpt(); ?>
                            </dd>
                        </dl>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/new.png" alt="" class="new">
                    </a>
                </li>

                <?php endwhile; ?>
                <?php $wp_query = null; $wp_query = $temp; ?>

            </ul>
        </section>

        <div class="more_link">
            <a href="<?php echo home_url(); ?>/tag/update/">更新作品一覧&emsp;<i class="fas fa-angle-right"></i></a>
        </div>

    </div>
</article>


<!-- ==========================================================
    banner
===============================================================-->


<?php tsuzuriBanner(); ?>



<!-- ==========================================================
    site description
===============================================================-->

<article class="site_d" <?php site_description_bg(); ?>>
    <div class="site_d_msk"></div>
    <div class="wrap">
        <h3><?php site_d_heading(); ?></h3>
        <p><?php site_d_text(); ?></p>
        <?php site_d_button(); ?>
    </div>
</article>


<!-- ==========================================================
    news
===============================================================-->

<article class="news_area">
    <div class="wrap">
        <section>
            <h3>お知らせ</h3>
            <div class="news_list">
                <ul>
                    <?php
                    $temp = $wp_query;
                    $wp_query = null;
                    $wp_query = new WP_Query();
                    $wp_query->query('post_type=post' . '&posts_per_page=5' . '&tag=news' . '&paged=' . $paged);
                    ?>
                    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                    <li><a href="<?php the_permalink(); ?>"><span class="news_data"><?php echo get_the_date('Y年n月j日'); ?></span><?php the_title(); ?></a></li>

                    <?php endwhile; ?>
                    <?php $wp_query = null; $wp_query = $temp; ?>
                </ul>
            </div>
            <div class="more_link">
                <a href="<?php echo home_url(); ?>/tag/news/">お知らせ一覧&emsp;<i class="fas fa-angle-right"></i></a>
            </div>
        </section>
    </div>
</article>


<!-- ==========================================================
    pick up
===============================================================-->

<article class="pickup_area">
    <div class="pu_inner">
        <h3>注目作品</h3>
        <section>
            <ul>

                <?php
                $temp = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query();
                $wp_query->query('post_type=post' . '&posts_per_page=3' . '&tag=pickup' . '&paged=' . $paged);
                ?>
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                <li>
                    <a href="<?php the_permalink(); ?>">
                        <dl>
                            <dt>
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                }else {
                                    defaultImg();
                                } ?>
                            </dt>
                            <dd>
                                <h4><?php the_title(); ?></h4>
                                <?php echo get_the_excerpt(); ?>
                            </dd>
                        </dl>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/pickup.png" alt="" class="pickup">
                    </a>
                </li>

                <?php endwhile; ?>
                <?php $wp_query = null; $wp_query = $temp; ?>

            </ul>
        </section>
        <div class="more_link">
            <a href="<?php echo home_url(); ?>/tag/pickup/">過去のピックアップ作品&emsp;<i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</article>


<?php get_footer(); ?>
