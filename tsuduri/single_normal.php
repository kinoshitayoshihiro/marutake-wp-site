<?php
/*
Template Name: 通常投稿ページ（2カラム）
Template Post Type: post
*/
?>

<?php get_header(); ?>

<!-- ==========================================================
    nav
===============================================================-->

<?php get_template_part('nav'); ?>


<!-- ==========================================================
    contents
===============================================================-->

<article class="single_normal_area">
    <section class="sn_wrap">

        <div class="sn_main_area">

            <?php
                if(have_posts()):
                while(have_posts()):
                the_post();
            ?>

            <?php add_tag(); ?>
            <?php add_tag2(); ?>
            <?php add_tag3(); ?>

            <h2><?php the_title(); ?></h2>

            <div class="sn_data">
                <span class="sn_data_ymd"><time class="first_ymd"><?php echo get_the_date('Y年m月d日'); ?></time><?php if(get_the_time('Y/m/d') != get_the_modified_date('Y/m/d')):?><time class="latest_ymd"><?php the_modified_date('Y年m月d日') ?></time><?php endif;?></span>
                <span class="sn_data_a"><?php the_category(''); ?></span>
                <div class="tag_list"><?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?></div>
            </div>

            <div class="snm_inner">
                <?php the_content(); ?>
                <?php get_template_part('author-section'); ?>
            </div>

            <?php endwhile; endif; ?>

            <div class="post_link">
                <?php if(have_posts()): while(have_posts()): the_post(); ?>
                <?php get_template_part('content'); ?>

                <span class="prev"><?php previous_post_link('« %link', '%title', TRUE, ''); ?></span>
                <span class="next"><?php next_post_link('%link »', '%title', TRUE, ''); ?></span>

                <?php endwhile; endif; ?>
            </div>

            <?php comments_template(); ?>

            <?php sns_share(); ?>

        </div>

        <div class="sidebar_area">
            <?php get_sidebar(); ?>
        </div>

    </section>

</article>


<?php get_footer(); ?>
