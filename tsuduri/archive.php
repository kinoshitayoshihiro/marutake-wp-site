<?php get_header(); ?>

<!-- ==========================================================
    nav
===============================================================-->

<?php get_template_part('nav'); ?>


<!-- ==========================================================
    archive
===============================================================-->

<article class="archive_main_area">
    <section class="archive_wrap">

        <h2><?php the_archive_title(); ?></h2>

        <div class="archive_list">

            <ul>

                <?php
                    if(have_posts()):
                    while(have_posts()):
                    the_post();
                ?>

                <li>
                    <dl>
                        <dt><a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                }else {
                                    defaultImg();
                                } ?></a></dt>
                        <dd>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="a_category"><?php the_category('&emsp;'); ?></div>
                            <?php echo get_the_excerpt(); ?>
                        </dd>
                    </dl>
                </li>

                <?php endwhile; endif; ?>

            </ul>

        </div>

        <div class="pagination">
            <?php pagination(); ?>
        </div>

    </section>
</article>

<?php get_footer(); ?>
