<?php

/********************************************************
* nav
********************************************************/

register_nav_menu('navigation' , 'メインナビゲーション');
register_nav_menu('foot_navigation' , 'フッターナビゲーション');


/********************************************************
* logo
********************************************************/

add_theme_support( 'custom-logo', array(
'flex-height' => true,
) );


/********************************************************
* eye catching
********************************************************/

add_theme_support('post-thumbnails');


/********************************************************
* over view
********************************************************/

function my_length($length) {
    return 100;
}
add_filter('excerpt_mblength','my_length');

function my_more($more) {
    return '…';
}
add_filter('excerpt_more', 'my_more');


/********************************************************
* pankuzu
********************************************************/

function mytheme_breadcrumb() {
    $sep = ' > ';
    echo '<a href="'.get_bloginfo('url').'" ><i class="fas fa-home"></i> サイトトップ</a>';
    echo $sep;

    $cats = '';
    $cat_id = '';
    if ( is_single() ) {
        $cats = get_the_category();
        if( isset($cats[0]->term_id) ) $cat_id = $cats[0]->term_id;
    }
    else if ( is_category() ) {
        $cats = get_queried_object();
        $cat_id = $cats->parent;
    }
    $cat_list = array();
    while ($cat_id != 0){
        $cat = get_category( $cat_id );
        $cat_link = get_category_link( $cat_id );
        array_unshift( $cat_list, '<a href="'.$cat_link.'">'.$cat->name.'</a>' );
        $cat_id = $cat->parent;
    }
    foreach($cat_list as $value){
        echo $value;
        echo $sep;
    }

    if ( is_singular() ) {
        if ( is_attachment() ) {
            previous_post_link( '%link' );
            echo $sep;
        }
        the_title();
    }
    else if( is_archive() ) the_archive_title();
    else if( is_search() ) echo '検索 : '.get_search_query();
    else if( is_404() ) echo 'ページが見つかりません';
}


/********************************************************
* archive setting
********************************************************/

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_post_type_archive() ){
        $title = post_type_archive_title('', false );
    }
    return $title;
});


/********************************************************
* sidebar
********************************************************/

register_sidebar();


/********************************************************
* comment
********************************************************/

function my_comment_form_remove($arg) {
    $args['comment_notes_before'] = '';
    $args['comment_notes_after'] = '';
    $arg['email'] = '';
    $arg['url'] = '';
    return $arg;
}

add_filter('comment_form_default_fields', 'my_comment_form_remove');

function custom_comment_form($args) {
    $args['logged_in_as'] = '<div id="logout"><a href="'.  wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) .'">ログアウト</a></div>';
    return $args;
}
add_filter('comment_form_defaults', 'custom_comment_form');



/********************************************************
* description & keyword custom
********************************************************/


add_action('admin_menu', 'add_custom_fields');
add_action('save_post', 'save_custom_fields');

function add_custom_fields() {
  add_meta_box( 'my_sectionid', 'ページ設定', 'my_custom_fields', 'post');
  add_meta_box( 'my_sectionid', 'ページ設定', 'my_custom_fields', 'page');
}

function my_custom_fields() {
  global $post;
  $keywords = get_post_meta($post->ID,'keywords',true);
  $description = get_post_meta($post->ID,'description',true);
  $robot = get_post_meta($post->ID,'robot',true);

  echo '<p>キーワード（半角カンマ区切り）<br>';
  echo '<input type="text" name="keywords" value="'.esc_html($keywords).'" size="60"></p>';

  echo '<p>ページの説明（description）160文字以内<br>';
  echo '<input type="text" style="width: 100%;height: 40px;" name="description" value="'.esc_html($description).'" maxlength="160"></p>';

    echo '<p>NOINDEXに設定する<br>';
    if(esc_html($robot)){
        $checked = 'checked="checked"';
    } else {
        $checked = '';
    }
    echo '<input type="checkbox" name="robot" ' . $checked . ' >NOINDEXに設定する';

}


function save_custom_fields( $post_id ) {
  if(!empty($_POST['keywords']))
    update_post_meta($post_id, 'keywords', $_POST['keywords'] );
  else delete_post_meta($post_id, 'keywords');

  if(!empty($_POST['description']))
    update_post_meta($post_id, 'description', $_POST['description'] );
  else delete_post_meta($post_id, 'description');

    if(!empty($_POST['robot']))
    update_post_meta($post_id, 'robot', $_POST['robot'] );
  else delete_post_meta($post_id, 'robot');
}

function page_description() {

$custom = get_post_custom();
if(!empty( $custom['keywords'][0])) {
  $keywords = $custom['keywords'][0];
}
if(!empty( $custom['description'][0])) {
  $description = $custom['description'][0];
}
    if(!empty( $custom['robot'][0])) {
  $robot = $custom['robot'][0];
}
?>

<?php if(is_home() || is_front_page()): // top page ?>
<title>
    <?php the_title(); ?>
</title>
<?php
    if($robot){
        echo '<meta name="robots" content="noindex, follow">';
    } else {
        echo '<meta name="robots" content="index, follow">';
    }
?>
<meta name="keywords" content="<?php echo $keywords ?>">
<meta name="description" content="<?php echo $description ?>">
<meta property="og:description" content="<?php echo $description ?>">
<?php elseif(is_single()): // 記事ページ ?>
<title>
    <?php the_title(); ?>｜
    <?php bloginfo('name'); ?>
</title>
<?php
    if($robot){
        echo '<meta name="robots" content="noindex, follow">';
    } else {
        echo '<meta name="robots" content="index, follow">';
    }
?>
<meta name="keywords" content="<?php echo $keywords ?>">
<meta name="description" content="<?php echo $description ?>">
<meta property="og:description" content="<?php echo $description ?>">
<?php elseif(is_page()): // 固定ページ ?>
<title>
    <?php the_title(); ?>｜
    <?php bloginfo('name'); ?>
</title>
<?php
    if($robot){
        echo '<meta name="robots" content="noindex, follow">';
    } else {
        echo '<meta name="robots" content="index, follow">';
    }
?>
<meta name="keywords" content="<?php echo $keywords ?>">
<meta name="description" content="<?php echo $description ?>">
<meta property="og:description" content="<?php echo $description ?>">
<?php elseif (is_category()): // カテゴリーページ ?>
<title>
    <?php single_cat_title(); ?>の記事一覧｜
    <?php bloginfo('name'); ?>
</title>
<meta name="robots" content="index, follow">
<meta name="description" content="<?php single_cat_title(); ?>の記事一覧">
<meta property="og:description" content="<?php single_cat_title(); ?>の記事一覧">
<?php elseif (is_tag()): // タグページ ?>
<title>
    <?php single_tag_title("", true); ?>の記事一覧｜
    <?php bloginfo('name'); ?>
</title>
<meta name="robots" content="noindex, follow">
<meta name="description" content="<?php single_tag_title("", true); ?>の記事一覧">
<meta property="og:description" content="<?php single_tag_title("", true); ?>の記事一覧">
<?php elseif(is_404()): // 404ページ ?>
<title>
    <?php echo 'お探しのページが見つかりませんでした'; ?>
</title>
<meta name="robots" content="noindex, follow">
<?php else: // その他ページ ?>
<title>
    <?php the_title(); ?>｜
    <?php bloginfo('name'); ?>
</title>
<meta name="robots" content="noindex, follow">
<?php endif; ?>
<?php
}


/********************************************************
* custom css
********************************************************/

add_action( 'admin_menu', 'custom_css_hooks' );
add_action( 'save_post', 'save_custom_css' );
add_action( 'wp_head','insert_custom_css' );
function custom_css_hooks() {
  add_meta_box( 'custom_css', 'Custom CSS', 'custom_css_input', 'post', 'normal', 'high' );
  add_meta_box( 'custom_css', 'Custom CSS', 'custom_css_input', 'page', 'normal', 'high' );
}
function custom_css_input() {
  global $post;
  echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="'.wp_create_nonce('custom-css').'" />';
  echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_css',true).'</textarea>';
}
function save_custom_css($post_id) {
  if ( !wp_verify_nonce( $_POST['custom_css_noncename'], 'custom-css' ) ) return $post_id;
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return $post_id;
  $custom_css = $_POST['custom_css'];
  update_post_meta( $post_id, '_custom_css', $custom_css );
}
function insert_custom_css() {
  if ( is_page() || is_single() ) {
    if ( have_posts() ) : while ( have_posts() ) : the_post();
      echo '<style type="text/css">' . get_post_meta(get_the_ID(), '_custom_css', true) . '</style>';
    endwhile; endif;
    rewind_posts();
  }
}


/********************************************************
* custom js
********************************************************/

add_action( 'admin_menu', 'custom_js_hooks' );
add_action( 'save_post', 'save_custom_js' );
add_action( 'wp_head','insert_custom_js' );
function custom_js_hooks() {
  add_meta_box( 'custom_js', 'Custom JS', 'custom_js_input', 'post', 'normal', 'high' );
  add_meta_box( 'custom_js', 'Custom JS', 'custom_js_input', 'page', 'normal', 'high' );
}
function custom_js_input() {
  global $post;
  echo '<input type="hidden" name="custom_js_noncename" id="custom_js_noncename" value="'.wp_create_nonce('custom-js').'" />';
  echo '<textarea name="custom_js" id="custom_js" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_js',true).'</textarea>';
}
function save_custom_js($post_id) {
  if (!wp_verify_nonce($_POST['custom_js_noncename'], 'custom-js')) return $post_id;
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
  $custom_js = $_POST['custom_js'];
  update_post_meta($post_id, '_custom_js', $custom_js);
}
function insert_custom_js() {
  if ( is_page() || is_single() ) {
    if ( have_posts() ) : while ( have_posts() ) : the_post();
      echo '<script type="text/javascript">' . get_post_meta(get_the_ID(), '_custom_js', true) . '</script>';
    endwhile; endif;
    rewind_posts();
  }
}


/********************************************************
* pagination
********************************************************/

if( !function_exists('pagination') ){
  function pagination($pages = '', $range = 4){
    $showitems = ($range * 2)+1;

    global $paged;
    if( empty($paged) ){
      $paged = 1;
    }
    if( $pages == '' ){
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if( !$pages ){
        $pages = 1;
      }
    }

    if( 1 != $pages ){

      if( $paged > 2 && $paged > $range+1 && $showitems < $pages ){
        echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
      }
      if( $paged > 1 && $showitems < $pages ){
        echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
      }
      for ($i=1; $i <= $pages; $i++){
        if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
          echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\"" . $page_no_index . ">" . $i . "</a>";
        }
      }

      if ( $paged < $pages && $showitems < $pages ){
        echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
      }
      if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ){
        echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
      }
      echo "</div>\n";
    }
  }
}


/********************************************************
* theme option
********************************************************/

require( dirname( __FILE__ ) . '/inc/theme-options.php' );
add_action('admin_head', 'mioAddCss');

function mioAddCss(){
    $addCssPath = get_template_directory_uri().'/css/add.css';
    wp_enqueue_style( 'theme', $addCssPath , false);
}


/********************************************************
* plugin
********************************************************/

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'ja_register_required_plugins' );

function ja_register_required_plugins() {

    $plugins = array(
        array(
            'name'               => 'Table of Contents Plus',
            'slug'               => 'tgm-example-plugin',
            'source'             => dirname( __FILE__ ) . '/plugins/table-of-contents-plus.1601.zip',
            'required'           => false,
            'version'            => '',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'WP-Yomigana',
            'slug'               => 'tgm-example-plugin3',
            'source'             => dirname( __FILE__ ) . '/plugins/wp-yomigana.2.0.2.zip',
            'required'           => false,
            'version'            => '',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'Classic Editor',
            'slug'               => 'tgm-example-plugin4',
            'source'             => dirname( __FILE__ ) . '/plugins/classic-editor.1.3.zip',
            'required'           => false,
            'version'            => '',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
        array(
            'name'               => 'tsuduri_gutenberg',
            'slug'               => 'tsuduri_gutenberg',
            'source'             => dirname( __FILE__ ) . '/plugins/tsuduri_gutenberg.zip',
            'required'           => false,
            'version'            => '',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => '',
        ),
    );

    $config = array(
        'id'           => 'ja',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'plugins.php',
        'capability'   => 'manage_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa( $plugins, $config );
}


/********************************************************
* color setting
********************************************************/

function stinger_customize_register($wp_customize) {
    $wp_customize->add_section( 'stinger_menu_customize', array(
    'title' => __( 'カラーデザイン', 'stinger' ),
    'priority' => 30,
    ) );

    $wp_customize->add_setting( 'stinger_menu_color1', array( 'default' => '#1a1a1a', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stinger_menu_color1', array(
    'label' => __( 'メインカラー', 'stinger' ),
    'section' => 'stinger_menu_customize',
    'settings' => 'stinger_menu_color1',
    ) ) );

    $wp_customize->add_setting( 'stinger_menu_color2', array( 'default' => '#cccccc', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stinger_menu_color2', array(
    'label' => __( 'ロゴカラー（テキスト）', 'stinger' ),
    'section' => 'stinger_menu_customize',
    'settings' => 'stinger_menu_color2',
    ) ) );

    $wp_customize->add_setting( 'stinger_menu_color3', array( 'default' => '#333333', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stinger_menu_color3', array(
    'label' => __( '区切り線カラー', 'stinger' ),
    'section' => 'stinger_menu_customize',
    'settings' => 'stinger_menu_color3',
    ) ) );

    $wp_customize->add_setting( 'stinger_menu_color4', array( 'default' => '#fafafa', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stinger_menu_color4', array(
    'label' => __( 'メニューカラー', 'stinger' ),
    'section' => 'stinger_menu_customize',
    'settings' => 'stinger_menu_color4',
    ) ) );

    $wp_customize->add_setting( 'stinger_menu_color5', array( 'default' => '#333333', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stinger_menu_color5', array(
    'label' => __( 'サブメニューカラー', 'stinger' ),
    'section' => 'stinger_menu_customize',
    'settings' => 'stinger_menu_color5',
    ) ) );

    $wp_customize->add_setting( 'stinger_menu_color6', array( 'default' => '#ffffff', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stinger_menu_color6', array(
    'label' => __( '開閉ボタンカラー', 'stinger' ),
    'section' => 'stinger_menu_customize',
    'settings' => 'stinger_menu_color6',
    ) ) );

    $wp_customize->add_setting( 'stinger_menu_color7', array( 'default' => '#333333', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stinger_menu_color7', array(
    'label' => __( 'ホバーカラー', 'stinger' ),
    'section' => 'stinger_menu_customize',
    'settings' => 'stinger_menu_color7',
    ) ) );
}

add_action('customize_register', 'stinger_customize_register');

function stinger_customize_css(){
    //format
    $menu_color1 = get_theme_mod( 'stinger_menu_color1', '#1a1a1a');
    $menu_color2 = get_theme_mod( 'stinger_menu_color2', '#cccccc');
    $menu_color3 = get_theme_mod( 'stinger_menu_color3', '#333333');
    $menu_color4 = get_theme_mod( 'stinger_menu_color4', '#fafafa');
    $menu_color5 = get_theme_mod( 'stinger_menu_color5', '#333333');
    $menu_color6 = get_theme_mod( 'stinger_menu_color6', '#ffffff');
    $menu_color7 = get_theme_mod( 'stinger_menu_color7', '#333333');
    ?>
    <style type="text/css">
        .main_nav {
            background: <?php echo $menu_color1; ?>;
        }

        .header_logo h1,
        .header_logo h1 a{
            color: <?php echo $menu_color2; ?>;
        }

        .main_nav .main_nav_inner {
            border-top: solid 1px <?php echo $menu_color3; ?>;
        }

        .main_menu .menu > li ,
        .main_menu .menu > li a,
        .main_menu .menu > li > .sub-menu > li::before{
            color: <?php echo $menu_color4; ?>;
        }

        .main_menu .menu > li:hover > .sub-menu {
            background: <?php echo $menu_color5; ?>;
        }

        .line-menu {
            background-color: <?php echo $menu_color6; ?>;
        }


        @media only screen and (max-width: 1200px) {

            .main_menu .menu > li:hover {
                background: <?php echo $menu_color7; ?>;
            }

            .main_menu .menu > li > .sub-menu {
                background: <?php echo $menu_color7; ?>;
            }

            .main_menu .menu > li:hover > .sub-menu {
                background: <?php echo $menu_color7; ?>;
            }

        }

    </style>
<?php }

add_action( 'wp_head', 'stinger_customize_css');



/********************************************************
* tool bar
********************************************************/

add_filter( 'mce_buttons', 'remove_mce_buttons' );
function remove_mce_buttons( $buttons ) {
  $remove = array(
    'italic',
    'numlist',
    'wp_more',
  );
  return array_diff( $buttons, $remove );
}

add_filter( 'mce_buttons_2', 'remove_mce_buttons_2' );
function remove_mce_buttons_2( $buttons ) {
  $remove = array();
  return array_diff( $buttons, $remove );
}

function custom_editor_settings( $initArray ){
 $initArray['block_formats'] = "見出し1=h3; 見出し2=h4; 見出し3=h5; 段落=p; 整形済み=pre;";
 return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );



/********************************************************
* ビジュアルエディタにボタン追加
********************************************************/
function custom_mce_buttons( $buttons ) {
    $buttons[] = 'button_em';
    $buttons[] = 'button_yohaku';
    $buttons[] = 'button_ten';
    $buttons[] = 'button_next_story';
    $buttons[] = 'button_prev_story';
    $buttons[] = 'button_series';
    $buttons[] = 'button_normal';
    return $buttons;
}

function custom_mce_external_plugins( $plugin_array ) {
    $plugin_array['custom_button_script'] = get_template_directory_uri() . "/js/tinymce.js";
    return $plugin_array;
}

add_filter( 'mce_buttons', 'custom_mce_buttons' );
add_filter( 'mce_external_plugins', 'custom_mce_external_plugins' );


/********************************************************
* pickupタグの追加
********************************************************/

add_action('admin_menu', 'add_tag_fields');
add_action('save_post', 'save_tag_fields');

function add_tag_fields() {
  add_meta_box( 'pickup_tag', 'ピックアップ記事に追加', 'my_tag_fields', 'post');
}

function my_tag_fields() {
  global $post;
  $tag = get_post_meta($post->ID,'tag',true);

    echo '<p>ピックアップ記事に追加する<br>';
    if(esc_html($tag)){
        $checked2 = 'checked="checked"';
    } else {
        $checked2 = '';
    }
    echo '<input type="checkbox" name="tag" ' . $checked2 . ' >ピックアップ記事に追加する';

}

function save_tag_fields( $post_id ) {
    if(!empty($_POST['tag']))
    update_post_meta($post_id, 'tag', $_POST['tag'] );
  else delete_post_meta($post_id, 'tag');
}

function add_tag() {
    $custom = get_post_custom();
    if(!empty( $custom['tag'][0])) {
      $tag = $custom['tag'][0];
    }

    $post_number = get_the_ID();

    if($tag){
        wp_set_post_tags( $post_number, 'pickup', true );
    } else {
        wp_remove_object_terms($post_number, 'pickup', 'post_tag');
    }
}



/********************************************************
* updateタグの追加
********************************************************/

add_action('admin_menu', 'add_tag_fields2');
add_action('save_post', 'save_tag_fields2');

function add_tag_fields2() {
  add_meta_box( 'update_tag', '更新作品に追加', 'my_tag_fields2', 'post');
}

function my_tag_fields2() {
  global $post;
  $tag2 = get_post_meta($post->ID,'tag2',true);

    echo '<p>更新作品に追加する<br>';
    if(esc_html($tag2)){
        $checked3 = 'checked="checked"';
    } else {
        $checked3 = '';
    }
    echo '<input type="checkbox" name="tag2" ' . $checked3 . ' >更新作品に追加する';

}

function save_tag_fields2( $post_id ) {
    if(!empty($_POST['tag2']))
    update_post_meta($post_id, 'tag2', $_POST['tag2'] );
  else delete_post_meta($post_id, 'tag2');
}

function add_tag2() {
    $custom = get_post_custom();
    if(!empty( $custom['tag2'][0])) {
      $tag2 = $custom['tag2'][0];
    }

    $post_number = get_the_ID();

    if($tag2){
        wp_set_post_tags( $post_number, 'update', true );
    } else {
        wp_remove_object_terms($post_number, 'update', 'post_tag');
    }
}

/********************************************************
* newsタグの追加
********************************************************/

add_action('admin_menu', 'add_tag_fields3');
add_action('save_post', 'save_tag_fields3');

function add_tag_fields3() {
  add_meta_box( 'news_tag', 'お知らせに追加', 'my_tag_fields3', 'post');
}

function my_tag_fields3() {
  global $post;
  $tag3 = get_post_meta($post->ID,'tag3',true);

    echo '<p>お知らせに追加する<br>';
    if(esc_html($tag3)){
        $checked4 = 'checked="checked"';
    } else {
        $checked4 = '';
    }
    echo '<input type="checkbox" name="tag3" ' . $checked4 . ' >お知らせに追加する';

}

function save_tag_fields3( $post_id ) {
    if(!empty($_POST['tag3']))
    update_post_meta($post_id, 'tag3', $_POST['tag3'] );
  else delete_post_meta($post_id, 'tag3');
}

function add_tag3() {
    $custom = get_post_custom();
    if(!empty( $custom['tag3'][0])) {
      $tag3 = $custom['tag3'][0];
    }

    $post_number = get_the_ID();

    if($tag3){
        wp_set_post_tags( $post_number, 'news', true );
    } else {
        wp_remove_object_terms($post_number, 'news', 'post_tag');
    }
}


/********************************************************
* SNSシェア機能
********************************************************/

function sns_share(){
    $share_url = get_permalink();
    $share_title = get_the_title();
    ?>

<div class="snsShare">
    <ul>
        <li class="share_fb">
            <a href="//www.facebook.com/sharer.php?src=bm&u=<?=$share_url?>&t=<?=$share_title?>" title="Facebookでシェア" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=600');return false;"><i class="fab fa-facebook-f"></i></a>
        </li>
        <li class="share_twitter">
            <a href="//twitter.com/share?text=<?=$share_title?>&url=<?=$share_url?>" title="Twitterでシェア" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;"><i class="fab fa-twitter"></i></a>
        </li>
        <li class="share_line">
            <a href="//line.me/R/msg/text/?<?=$share_title.'%0A'.$share_url?>" target="_blank" title="LINEに送る"><i class="fab fa-line"></i></a>
        </li>
        <li class="share_hatena">
            <a href="//b.hatena.ne.jp/add?mode=confirm&url=<?=$share_url?>" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=1000');return false;" title="はてなブックマークに登録"><i class="fa fa-hatena"></i></a>
        </li>

    </ul>
</div>

<?php
}


/********************************************************
* ユーザー情報の追加
********************************************************/

function my_user_meta($wb){
    $wb['twitter'] = 'Twitter URL';
    $wb['fb'] = 'FaceBook URL';
    $wb['instagram'] = 'Instagram URL';
    $wb['hp'] = 'HomePage URL';
    return $wb;
}
add_filter('user_contactmethods', 'my_user_meta', 10, 1);

