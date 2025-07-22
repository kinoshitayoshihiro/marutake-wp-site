<?php
/* ------------------------------------------------------------
* このファイルはユーザー情報のパーツファイルです。
*
* 登録されているユーザーの情報を出力します。ユーザー情報はfunctions.phpで増やすことができます。なお、このパーツファイルのコードはサンプルなので、適宜自由に変更してください。役職・SNSリンクはカスタム要素で増やしています。
------------------------------------------------------------ */
?>


<!--/------------------------------------------------------------
* ↓↓↓↓↓ここからコーディング開始↓↓↓↓↓
------------------------------------------------------------/-->

<div class="authorArea">
    <dl>

        <dt>
            <ul>
                <li>
                    <?php echo get_avatar( get_the_author_id()); ?><!--ユーザーのアバターを出力-->
                </li>
                <li><small>筆者</small><br>
                    <?php the_author(); ?><!--ユーザー名の出力-->
                </li>
            </ul>
        </dt>
        <dd>

            <div class="profile"><?php the_author_meta('user_description'); ?><!--ユーザーの説明文を出力--></div>

            <div class="authorSns"><!--以下、SNSのリンクがあれば出力-->
                <ul>
                    <?php if(get_the_author_meta('twitter') != ""): ?>
                    <li><a href="<?php the_author_meta('twitter'); ?>"><i class="fab fa-twitter-square"></i></a></li>
                    <?php endif; ?>
                    <?php if(get_the_author_meta('fb') != ""): ?>
                    <li><a href="<?php the_author_meta('fb'); ?>"><i class="fab fa-facebook"></i></a></li>
                    <?php endif; ?>
                    <?php if(get_the_author_meta('instagram') != ""): ?>
                    <li><a href="<?php the_author_meta('instagram'); ?>"><i class="fab fa-instagram"></i></a></li>
                    <?php endif; ?>
                    <?php if(get_the_author_meta('hp') != ""): ?>
                    <li><a href="<?php the_author_meta('hp'); ?>"><i class="fas fa-desktop"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </dd>

    </dl>
</div>

<!--/------------------------------------------------------------
* ↑↑↑↑↑コーディングここまで↑↑↑↑↑
------------------------------------------------------------/-->
