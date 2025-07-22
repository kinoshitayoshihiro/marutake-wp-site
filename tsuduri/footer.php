<!-- ==========================================================
    pankuzu
===============================================================-->

<?php if( !( is_home() || is_front_page() ) && !is_paged() ) :
  get_template_part('pankuzu');
 endif; ?>


<!-- ==========================================================
        footer
    ===============================================================-->

<footer>

    <nav id="foot_nav">
        <?php wp_nav_menu('theme_location=foot_navigation'); ?>
    </nav>

    <div class="foot_inner">
        <div class="foot_logo">
            <a href="<?php echo home_url(); ?>"><?php the_custom_logo();
            if (!has_custom_logo()) {
            bloginfo('name');
            } ?></a>
        </div>

        <p class="copy"><small>&copy;COPYRIGHT(C) <span id="copydate"></span> - <?php bloginfo('name'); ?> All Rights Reserved.<br>Made by <a href="https://neco-fly.com/themes/tsuduri-download/">wordpress theme 綴</a></small></p>
    </div>

    <div class="scroll_top">
        <i class="fas fa-angle-up"></i>
    </div>

</footer>


<?php wp_footer(); ?>
</body>

</html>
