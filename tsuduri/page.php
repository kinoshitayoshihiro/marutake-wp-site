<?php get_header(); ?>

<!-- ==========================================================
    nav
===============================================================-->

<?php get_template_part('nav'); ?>


<!-- ==========================================================
    contents
===============================================================-->

<article class="page_main_area">
    <section class="novel_wrap">
        <div class="vertical_c">

            <?php
                if(have_posts()):
                while(have_posts()):
                the_post();
            ?>

            <h2 id="top"><?php the_title(); ?></h2>
            <?php the_content(); ?>

            <?php endwhile; endif; ?>

        </div>
    </section>

    <div class="novel_cont">
        <div id="scroll_bar_wrap"><div class="novel_now_bar_inner"></div></div>
        <ul>
            <li class="small"><span>小</span></li>
            <li class="medium"><span>中</span></li>
            <li class="large"><span>大</span></li>
        </ul>
        <div class="r_top"><a href="#top">トップに戻る</a></div>
    </div>

</article>

<?php sns_share(); ?>
<?php get_footer(); ?>
