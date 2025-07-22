<?php
/*
Template Name: 通常固定ページ（1カラム）
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

        <div class="sn_main_area" id="one_column">

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

    </section>
</article>


<?php get_footer(); ?>

