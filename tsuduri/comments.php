<div id="comments">

    <?php comment_form( 'format=html5&title_reply=COMMENT' ); ?>

    <?php if( have_comments() ) : ?>
        <?php comments_number('コメント','<div class="cCount">1comment</div>','<div class="cCount">%comments</div>'); ?>
        <ul class="contribution">
            <?php wp_list_comments(); ?>
        </ul>
    <?php endif; ?>

</div>
