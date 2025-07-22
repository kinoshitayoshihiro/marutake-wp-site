<?php get_header(); ?>

<!-- ==========================================================
    nav
===============================================================-->

<?php get_template_part('nav'); ?>


<!-- ==========================================================
    contents
===============================================================-->

    <article class="search_main_area">
        <section class="wrap">
            <div class="search_r_list">

                <h2>“<?php the_search_query(); ?>”の検索結果</h2>

                <ul>

                    <?php if(have_posts()):
                    while(have_posts()):
                    the_post() ?>

                    <li><a href="<?php the_permalink(); ?>"><span class="news_data"><?php echo get_the_date('Y年n月j日'); ?></span><?php the_title(); ?></a></li>

                    <?php endwhile; ?>
                    <?php else: ?>

                    <p class="no_r">該当する記事はございません。</p>

                    <?php endif; ?>

                </ul>

            </div>

            <div class="pagination">
                <?php pagination(); ?>
            </div>

        </section>
    </article>

<?php get_footer(); ?>
