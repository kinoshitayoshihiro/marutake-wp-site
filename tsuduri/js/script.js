$(function () {

    /********************************************************
     * nav
     ********************************************************/

    var burgerMenu = $('.burger-menu');

    burgerMenu.on("click", function () {
        $(this).toggleClass('menu-open');
        $('.main_nav_inner').slideToggle(300);
    });

    if ($('.main_menu .menu > li').children('.sub-menu')) {
        $('.sub-menu').parent('.main_menu .menu > li').append('<i class="fas fa-plus sp_nav_icon"></i>');

        $('.sub-menu').parent('.main_menu .menu > li').on('click', function () {
            $(this).children('i').toggleClass('fa-plus').toggleClass('fa-minus');
            $(this).children('.sub-menu').slideToggle(0);
        });
    }


    /********************************************************
     * post
     ********************************************************/

    var news_l = $('.news_list li').length;
    if (news_l === 0) {
        $('.news_area').css({
            display: 'none'
        });
    } else {
        $('.news_area').css({
            display: 'block'
        });
    }

    var pickip_l = $('.pu_inner li').length;
    console.log(pickip_l);
    if (pickip_l === 0) {
        $('.pickup_area').css({
            display: 'none'
        });
    } else {
        $('.pickup_area').css({
            display: 'block'
        });
    }


    /********************************************************
     * scroll top
     ********************************************************/

    $('.scroll_top ').on('click', function () {
        $('html,body').animate({
            scrollTop: 0
        }, 500);
    });


    /********************************************************
     * novel control
     ********************************************************/

    $('.novel_cont ul .small').on('click', function () {
        $('.vertical_c > p').animate({
            fontSize: '14px'
        }, 200);
    });

    $('.novel_cont ul .large').on('click', function () {
        $('.vertical_c > p').animate({
            fontSize: '22px'
        }, 200);
    });

    $('.novel_cont ul .medium').on('click', function () {
        $('.vertical_c > p').animate({
            fontSize: '18px'
        }, 200);
    });


    /********************************************************
     * copy data
     ********************************************************/

    var now = new Date();
    var y = now.getFullYear();
    $('#copydate').text(y);


    /********************************************************
     * プログレスバー
     ********************************************************/

    //var message; デバック用
    var format = $(".novel_wrap").scrollLeft();//横スクロールの長さを取得

    $(".novel_wrap").scroll(function(){ //スクロールしたら都度関数実行
        var now_scroll = $(".novel_wrap").scrollLeft();//現在の横スクロール値
        var scroll_percent = (now_scroll / format)*100;//パーセントに変換
        scroll_percent = 100 - Math.round(scroll_percent)+ '%';//四捨五入して小数点以下を消す

        $('#scroll_bar_wrap .novel_now_bar_inner').animate({
            width : scroll_percent//アニメーションの実行
        },0);

        //message = 'スクロール値は現在' + scroll_percent + '%'; //デバック用
        //$("#scroll_bar_wrap").html(message); //デバック用
    });


});
