<?php
/*
Template Name: 通常固定ページ（2カラム）
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

            <h2><?php the_title(); ?></h2>

            <div class="snm_inner">
                <?php the_content(); ?>
            </div>

            <?php endwhile; endif; ?>

            <?php sns_share(); ?>

        </div>

        <div class="sidebar_area">
            <?php get_sidebar(); ?>
        </div>

    </section>
</article>


<?php get_footer(); ?>
