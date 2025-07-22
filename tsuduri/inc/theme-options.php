<?php

function mioDefaultThemeOptions() {
    $defaultThemeOptions = array(
    );
}

function mioGetThemeOptions() {
    return get_option( 'mioThemeOptions', mioDefaultThemeOptions() );
}

function mioThemeOptionsValidate( $input ) {
    $output = $defaults = mioDefaultThemeOptions();
  for ( $i = 1; $i <= 3 ;){
        $output['banner'.$i.'Img'] = $input['banner'.$i.'Img'];
        $output['banner'.$i.'Name'] = $input['banner'.$i.'Name'];
        $output['banner'.$i.'Link'] = $input['banner'.$i.'Link'];
    $i++;
    }
    $output['headerBG'] = $input['headerBG'];
    $output['site_d_BG'] = $input['site_d_BG'];
    $output['site_d_heading'] = $input['site_d_heading'];
    $output['site_d_text'] = $input['site_d_text'];
    $output['site_d_b_link'] = $input['site_d_b_link'];
    $output['site_d_b_text'] = $input['site_d_b_text'];
    $output['defaultImg'] = $input['defaultImg'];
    $output['ogpImg'] = $input['ogpImg'];
    $output['head_text'] = $input['head_text'];
    return apply_filters( 'mioThemeOptionsValidate', $output, $input, $defaults );
}

function mioThemeOptionsInit() {
    if ( false === mioGetThemeOptions() )
        add_option( 'mioThemeOptions', mioDefaultThemeOptions() );
    register_setting(
        'mioOptions',
        'mioThemeOptions',
        'mioThemeOptionsValidate'
    );
}

add_action( 'admin_init', 'mioThemeOptionsInit' );


//Add Page
function mioThemeOptionsAddPage() {
    $theme_page = add_theme_page(
        'テーマ設定',
        'テーマ設定',
        'edit_theme_options',
        'theme_options',
        'mioThemeOptionsPage'
    );
    if ( ! $theme_page )
        return;
}

add_action( 'admin_menu', 'mioThemeOptionsAddPage' );


//outoput theme-options-edit.php
get_template_part('inc/theme-options-edit');


// headerBG function
function headerBG(){
    $options = mioGetThemeOptions();
    $headerBG = $options['headerBG'];
    $defaultBG =  get_template_directory_uri() . '/images/header_img.jpg';

    if($headerBG){
        echo 'style="background-image: url(' . $headerBG . ');"';
    } else {
        echo 'style="background-image: url(' . $defaultBG . ');"';
    }
}


//banner function
function tsuzuriBanner() {
    $options = mioGetThemeOptions();

    $banner1Img = $options['banner1Img'];
    $banner2Img = $options['banner2Img'];
    $banner3Img = $options['banner3Img'];
    $banner1Name = $options['banner1Name'];
    $banner2Name = $options['banner2Name'];
    $banner3Name = $options['banner3Name'];
    $banner1Link = $options['banner1Link'];
    $banner2Link = $options['banner2Link'];
    $banner3Link = $options['banner3Link'];

    //output
    if ($banner1Img || $banner2Img || $banner3Img) {?>

    <aside class="banner">
        <div class="wrap">
            <div class="banner_list">
                <ul>
    <?php }

    //banner1
    if ($banner1Img) {?>
            <?php if ($banner1Link):?>
            <li><a href="<?php echo $banner1Link; ?>"><img src="<?php echo $banner1Img; ?>" alt="<?php echo $banner1Name; ?>" ></a></li>
            <?php else: ?>
            <li><img src="<?php echo $banner1Img; ?>" alt="<?php echo $banner1Name; ?>"></li>
            <?php endif;?>
            <?php }

    //banner2
    if ($banner2Img) {?>
            <?php if ($banner2Link):?>
            <li><a href="<?php echo $banner2Link; ?>"><img src="<?php echo $banner2Img; ?>" alt="<?php echo $banner2Name; ?>" ></a></li>
            <?php else: ?>
            <li><img src="<?php echo $banner2Img; ?>" alt="<?php echo $banner2Name; ?>"></li>
            <?php endif;?>
            <?php }

    //banner3
    if ($banner3Img) {?>
            <?php if ($banner3Link):?>
            <li><a href="<?php echo $banner3Link; ?>"><img src="<?php echo $banner3Img; ?>" alt="<?php echo $banner3Name; ?>" ></a></li>
            <?php else: ?>
            <li><img src="<?php echo $banner3Img; ?>" alt="<?php echo $banner3Name; ?>"></li>
            <?php endif;?>
            <?php }

    if ($banner1Img || $banner2Img || $banner3Img) {?>
                </ul>
            </div>
        </div>
    </aside>
    <?php }
}


// site description function
function site_description_bg(){
    $options = mioGetThemeOptions();
    $site_d_BG = $options['site_d_BG'];
    $site_default_BG =  get_template_directory_uri() . '/images/bg_sample.jpg';

    if($site_d_BG){
        echo 'style="background-image: url(' . $site_d_BG . ');"';
    } else {
        echo 'style="background-image: url(' . $site_default_BG . ');"';
    }
}

function site_d_heading(){
    $options = mioGetThemeOptions();
    $site_d_heading = $options['site_d_heading'];
    $site_d_heading_default =  '『綴』で物語を綴ろう';

    if($site_d_heading){
        echo $site_d_heading;
    } else {
        echo $site_d_heading_default;
    }
}

function site_d_text(){
    $options = mioGetThemeOptions();
    $site_d_text = $options['site_d_text'];
    $site_d_text_default =  'WordPressテーマ『綴』はWEB小説の公開に適したテンプレートです。<br>まずは下記のサンプルをご覧ください。';

    if($site_d_text){
        echo $site_d_text;
    } else {
        echo $site_d_text_default;
    }
}

function site_d_button(){
    $options = mioGetThemeOptions();
    $site_d_b_link = $options['site_d_b_link'];
    $site_d_b_text = $options['site_d_b_text'];

    if($site_d_b_link && $site_d_b_text){ ?>
        <div class="site_d_button">
            <a href="<?php echo $site_d_b_link; ?>"><?php echo $site_d_b_text; ?></a>
        </div>
    <?php }
}


// defaultImg function
function defaultImg(){
    $options = mioGetThemeOptions();
    $defaultImg = $options['defaultImg'];
    $defaultImg_default =  get_template_directory_uri() . '/images/default.jpg';

    if($defaultImg){
        echo '<img src="' . $defaultImg . '" alt="">';
    } else {
        echo '<img src="' . $defaultImg_default . '" alt="">';
    }
}


// ogpImg function
function ogpImg(){
    $options = mioGetThemeOptions();
    $ogpImg = $options['ogpImg'];
    $ogpImg_default =  get_template_directory_uri() . '/images/ogp_img.jpg';

    if($ogpImg){
        echo '<meta property="og:image" content="' . $ogpImg . '">';
    } else {
        echo '<meta property="og:image" content="' . $ogpImg_default . '">';
    }
}


// head tag

function head_text(){
    $options = mioGetThemeOptions();
    $head_text = $options['head_text'];

    if($head_text){
        echo $head_text;
    }
}
