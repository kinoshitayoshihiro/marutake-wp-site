<?php

function mioThemeOptionsPage() { ?>

<div class="wrap" id="mioOptions">
    <?php screen_icon(); ?>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'mioOptions' );
        $options = mioGetThemeOptions();
        $default_options = mioDefaultThemeOptions();
        ?>


        <div class="section">
            <h3>ヘッダー画像の設定</h3>
            <table>
                <tr>
                    <th>ヘッダー画像</th>
                </tr>
                <tr>
                    <td>
                        <p class="img"><img src="<?php if(isset($options['headerBG'])):?><?php echo esc_attr( $options['headerBG'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/header_img.jpg<?php endif;?>"></p>
                        <dl>
                            <dt>画像URL</dt>
                            <dd><input type="text" name="mioThemeOptions[headerBG]" id="banner1Img" value="<?php if(isset($options['headerBG'])):?><?php echo esc_attr( $options['headerBG'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/header_img.jpg<?php endif;?>" /><br />
                                <span>推奨画像サイズ：1920px * 1080px<br>未設定の場合はデフォルト画像が表示されます。</span></dd>
                        </dl>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </div>


        <div class="section">
            <h3>バナーの設定</h3>
            <table>
                <tr>
                    <th>バナー1</th>
                    <th>バナー2</th>
                </tr>
                <tr>
                    <td>
                        <p class="img"><img src="<?php if(isset($options['banner1Img'])):?><?php echo esc_attr( $options['banner1Img'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/banner_sample.jpg<?php endif;?>"></p>
                        <dl>
                            <dt>画像URL</dt>
                            <dd><input type="text" name="mioThemeOptions[banner1Img]" id="banner1Img" value="<?php if(isset($options['banner1Img'])):?><?php echo esc_attr( $options['banner1Img'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/banner_sample.jpg<?php endif;?>" /><br />
                                <span>推奨画像サイズ：900px * 230px<br>バナーが不要な場合は入力欄を空にしてください。</span></dd>
                            <dt>画像の情報　(alt属性)</dt>
                            <dd><input type="text" name="mioThemeOptions[banner1Name]" id="banner1Name" value="<?php echo esc_attr( $options['banner1Name'] ); ?>" /></dd>
                            <dt>リンク先のURL</dt>
                            <dd><input type="text" name="mioThemeOptions[banner1Link]" id="banner1Link" value="<?php echo esc_attr( $options['banner1Link'] ); ?>" /><br />
                                <span>設定しなくても構いません。</span></dd>
                        </dl>
                    </td>
                    <td>
                        <p class="img"><img src="<?php if(isset($options['banner2Img'])):?><?php echo esc_attr( $options['banner2Img'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php print get_template(); ?>/images/banner_sample.jpg<?php endif;?>"></p>
                        <dl>
                            <dt>画像URL</dt>
                            <dd><input type="text" name="mioThemeOptions[banner2Img]" id="banner2Img" value="<?php if(isset($options['banner2Img'])):?><?php echo esc_attr( $options['banner2Img'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php print get_template(); ?>/images/banner_sample.jpg<?php endif;?>" /><br />
                                <span>推奨画像サイズ：900px * 230px<br>バナーが不要な場合は入力欄を空にしてください。</span></dd>
                            <dt>画像の情報　(alt属性)</dt>
                            <dd><input type="text" name="mioThemeOptions[banner2Name]" id="banner2Name" value="<?php echo esc_attr( $options['banner2Name'] ); ?>" /></dd>
                            <dt>リンク先のURL</dt>
                            <dd><input type="text" name="mioThemeOptions[banner2Link]" id="banner2Link" value="<?php echo esc_attr( $options['banner2Link'] ); ?>" /><br />
                                <span>設定しなくても構いません。</span></dd>
                        </dl>
                    </td>
                </tr>

                <tr>
                    <th colspan="2">バナー3</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="img"><img src="<?php if(isset($options['banner3Img'])):?><?php echo esc_attr( $options['banner3Img'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/banner_sample.jpg<?php endif;?>"></p>
                        <dl>
                            <dt>画像URL</dt>
                            <dd><input type="text" name="mioThemeOptions[banner3Img]" id="banner3Img" value="<?php if(isset($options['banner3Img'])):?><?php echo esc_attr( $options['banner3Img'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/banner_sample.jpg<?php endif;?>" /><br />
                                <span>推奨画像サイズ：900px * 230px<br>バナーが不要な場合は入力欄を空にしてください。</span></dd>
                            <dt>画像の情報　(alt属性)</dt>
                            <dd><input type="text" name="mioThemeOptions[banner3Name]" id="banner3Name" value="<?php echo esc_attr( $options['banner3Name'] ); ?>" /></dd>
                            <dt>リンク先のURL</dt>
                            <dd><input type="text" name="mioThemeOptions[banner3Link]" id="banner3Link" value="<?php echo esc_attr( $options['banner3Link'] ); ?>" /><br />
                                <span>設定しなくても構いません。</span></dd>
                        </dl>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </div>



        <div class="section">
            <h3>サイト概要の設定</h3>
            <table>
                <tr>
                    <th>背景画像</th>
                </tr>
                <tr>
                    <td>
                        <p class="img"><img src="<?php if(isset($options['site_d_BG'])):?><?php echo esc_attr( $options['site_d_BG'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/bg_sample.jpg<?php endif;?>"></p>
                        <dl>
                            <dt>画像URL</dt>
                            <dd><input type="text" name="mioThemeOptions[site_d_BG]" id="site_d_BG_Img" value="<?php if(isset($options['site_d_BG'])):?><?php echo esc_attr( $options['site_d_BG'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/bg_sample.jpg<?php endif;?>" /><br />
                                <span>推奨画像サイズ：1920px * 1080px<br>未設定の場合はデフォルト画像が表示されます。</span></dd>
                        </dl>
                    </td>
                </tr>

                <tr>
                    <th>見出しテキスト</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="mioThemeOptions[site_d_heading]" id="site_d_heading" value="<?php if(isset($options['site_d_heading'])):?><?php echo esc_attr( $options['site_d_heading'] ); ?><?php else:?><?php echo '『綴』で物語を綴ろう'; endif;?>" /><br />
                            <span>未入力の場合、デフォルトテキストが表示されます。<br>（デフォルトテキスト：『綴』で物語を綴ろう）</span>
                    </td>
                </tr>

                <tr>
                    <th>テキスト</th>
                </tr>
                <tr>
                    <td>
                        <textarea type="text" name="mioThemeOptions[site_d_text]" id="site_d_text"><?php if(isset($options['site_d_text'])):?><?php echo esc_attr( $options['site_d_text'] ); ?><?php else:?><?php echo 'WordPressテーマ『綴』はWEB小説の公開に適したテンプレートです。<br>まずは下記のサンプルをご覧ください。'; endif;?></textarea><br />
                            <span>改行する場合は&lt;br&gt;タグをお使いください。<br>未入力の場合、デフォルトテキストが表示されます。<br>（デフォルトテキスト：WordPressテーマ『綴』はWEB小説の公開に適したテンプレートです。まずは下記のサンプルをご覧ください。）</span>
                    </td>
                </tr>

                <tr>
                    <th>リンクボタン</th>
                </tr>
                <tr>
                    <td>
                        <dl>
                            <dt>URL</dt>
                            <dd><input type="text" name="mioThemeOptions[site_d_b_link]" id="site_d_b_link" value="<?php if(isset($options['site_d_b_link'])):?><?php echo esc_attr( $options['site_d_b_link'] ); endif;?>" /><br />
                                <span>リンクを設置する場合、URLを記述してください。</span></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td>
                        <dl>
                            <dt>ボタンテキスト</dt>
                            <dd><input type="text" name="mioThemeOptions[site_d_b_text]" id="site_d_b_text" value="<?php if(isset($options['site_d_b_text'])):?><?php echo esc_attr( $options['site_d_b_text'] ); endif;?>" /><br />
                                <span>ボタンのテキストを記述してください。</span></dd>
                        </dl>
                    </td>
                </tr>

            </table>
            <?php submit_button(); ?>
        </div>


        <div class="section">
            <h3>その他の設定</h3>
            <table>
                <tr>
                    <th>デフォルト画像</th>
                </tr>
                <tr>
                    <td>
                        <p class="img"><img src="<?php if(isset($options['defaultImg'])):?><?php echo esc_attr( $options['defaultImg'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/default.jpg<?php endif;?>"></p>
                        <dl>
                            <dt>画像URL</dt>
                            <dd><input type="text" name="mioThemeOptions[defaultImg]" id="defaultImg" value="<?php if(isset($options['defaultImg'])):?><?php echo esc_attr( $options['defaultImg'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/default.jpg<?php endif;?>"><br>
                                <span>推奨画像サイズ：900px * 515px<br>デフォルト画像は、アイキャッチ画像未設定の場合に表示される代替画像です。<br>未入力の場合、初期画像が表示されます。</span></dd>
                        </dl>
                    </td>
                </tr>

                <tr>
                    <th>OGP画像</th>
                </tr>
                <tr>
                    <td>
                        <p class="img"><img src="<?php if(isset($options['ogpImg'])):?><?php echo esc_attr( $options['ogpImg'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/ogp_img.jpg<?php endif;?>"></p>
                        <dl>
                            <dt>画像URL</dt>
                            <dd><input type="text" name="mioThemeOptions[ogpImg]" id="ogpImg" value="<?php if(isset($options['ogpImg'])):?><?php echo esc_attr( $options['ogpImg'] ); ?><?php else:?><?php echo site_url(); ?>/wp-content/themes/<?php echo get_template(); ?>/images/ogp_img.jpg<?php endif;?>"><br>
                                <span>推奨画像サイズ：1200px * 630px<br>OGP画像は、SNSでシェアされた場合に表示される画像です。<br>未入力の場合、初期画像が表示されます。</span></dd>
                        </dl>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </div>


        <div class="section">
            <h3>head内にタグを追加（高度な設定）</h3>
            <table>
                <tr>
                    <th>head内にタグを追加</th>
                </tr>
                <tr>
                    <td>
                        <textarea type="text" name="mioThemeOptions[head_text]" id="head_text" style="height: 15em;"><?php if(isset($options['head_text'])):?><?php echo esc_attr( $options['head_text'] ); endif; ?></textarea><br />
                            <span>上記で入力した内容がheadタグ内に反映されます。追加CSSやアナリティクスのコード入力などにお使いください。<br>エラーの原因にもなるため、用途とは異なる仕様はお控えください。</span>
                    </td>
                </tr>

            </table>
            <?php submit_button(); ?>
        </div>




    </form>
</div>
<?php
}
