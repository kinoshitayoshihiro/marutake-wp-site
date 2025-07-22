<?php get_header(); ?>

 <!-- ==========================================================
    nav
===============================================================-->

<?php get_template_part('nav'); ?>


<!-- ==========================================================
    contents
===============================================================-->

<article class="single_main_area">
    <section class="novel_wrap">
        <div class="vertical_c">

            <?php
                if(have_posts()):
                while(have_posts()):
                the_post();
            ?>

            <?php add_tag(); ?>
            <?php add_tag2(); ?>
            <?php add_tag3(); ?>

            <h2 id="top"><?php the_title(); ?></h2>

            <div class="novel_data">
                <span class="v_n_d"><?php echo get_the_date('Y年m月d日'); ?></span>
                <div class="category"><?php the_category(''); ?></div>
                <div class="tag_list"><?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?></div>
            </div>

            <?php the_content(); ?>
            <?php endwhile; endif; ?>
            <?php get_template_part('author-section'); ?>
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

    <div class="post_link">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <?php get_template_part('content'); ?>

        <span class="prev"><?php previous_post_link('« %link', '%title', TRUE, ''); ?></span>
        <span class="next"><?php next_post_link('%link »', '%title', TRUE, ''); ?></span>

        <?php endwhile; endif; ?>
    </div>

</article>

<?php sns_share(); ?>
<?php get_footer(); ?>
