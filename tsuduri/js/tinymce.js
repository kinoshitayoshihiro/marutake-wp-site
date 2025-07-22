//このファイルはビジュアルエディタに新規ボタンを追加するためのコードです


(function() {
    tinymce.create('tinymce.plugins.MyButtons', {
        init : function(ed, url) {
            // 全角スペースボタン設定
            ed.addButton( 'button_em', {
                title : '全角スペースを追加',
                image : url + '/zenkaku_space_icon.png',
                cmd: 'button_em_cmd'
            });
            // 全角スペースボタンの動作
            ed.addCommand( 'button_em_cmd', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '<i>&emsp;</i>' + selected_text + '';
                ed.execCommand('mceInsertContent', 0, return_text);
            });

            // 余白ボタン設定
            ed.addButton( 'button_yohaku', {
                title : '余白を追加',
                image : url + '/yohaku_icon.png',
                cmd: 'button_yohaku_cmd'
            });
            // 余白ボタンの動作
            ed.addCommand( 'button_yohaku_cmd', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '<div class="yohaku"></div>' + selected_text + '';
                ed.execCommand('mceInsertContent', 0, return_text);
            });

            // 三点リーダーボタン設定
            ed.addButton( 'button_ten', {
                title : '三点リーダーを追加',
                image : url + '/santen_icon.png',
                cmd: 'button_ten_cmd'
            });
            // 三点リーダーボタンの動作
            ed.addCommand( 'button_ten_cmd', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '……' + selected_text + '';
                ed.execCommand('mceInsertContent', 0, return_text);
            });

            // 次の話ボタン設定
          ed.addButton( 'button_next_story', {
            title : '次の話に進む',
            image : url + '/next-story_icon.png',
            cmd: 'button_next_story_cmd'
          });
          // 次の話ボタンの動作
          ed.addCommand( 'button_next_story_cmd', function() {
              var selected_text = ed.selection.getContent();
              var raw_url = window.prompt('URLを入力してください','');
              var return_txt = '<span class="next_story_wrap"><a href="' + raw_url + '" class="next-story">次の話へ進む</a></span>' + selected_text;
            ed.execCommand('mceInsertContent', 0, return_txt);
          });

            // 前の話ボタン設定
          ed.addButton( 'button_prev_story', {
            title : '前の話に戻る',
            image : url + '/prev-story_icon.png',
            cmd: 'button_prev_story_cmd'
          });
          // 前の話ボタンの動作
          ed.addCommand( 'button_prev_story_cmd', function() {
              var selected_text = ed.selection.getContent();
              var raw_url = window.prompt('URLを入力してください','');
              var return_txt = '<span class="prev_story_wrap"><a href="' + raw_url + '" class="prev-story">前の話へ戻る</a></span>' + selected_text;
            ed.execCommand('mceInsertContent', 0, return_txt);
          });

             // シリーズボタン設定
          ed.addButton( 'button_series', {
            title : 'シリーズ一覧',
            image : url + '/series_icon.png',
            cmd: 'button_series_cmd'
          });
          // シリーズボタンの動作
          ed.addCommand( 'button_series_cmd', function() {
              var selected_text = ed.selection.getContent();
              var raw_url = window.prompt('シリーズ一覧ページのURLを入力してください','');
              var return_txt = '<span class="series_wrap"><a href="' + raw_url + '" class="series_link">シリーズ一覧はこちら</a></span>' + selected_text;
            ed.execCommand('mceInsertContent', 0, return_txt);
          });

              // 通常ボタン設定
          ed.addButton( 'button_normal', {
            title : 'ボタンを追加',
            image : url + '/normal_button_icon.png',
            cmd: 'button_normal_cmd'
          });
          // 通常ボタンの動作
          ed.addCommand( 'button_normal_cmd', function() {
              var selected_text = ed.selection.getContent();
              var raw_url = window.prompt('URLを入力してください','');
              var return_txt = '<div class="edit_button_link"><a href="' + raw_url + '">' + selected_text + '</a></span>';
            ed.execCommand('mceInsertContent', 0, return_txt);
          });


        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add( 'custom_button_script', tinymce.plugins.MyButtons );
})();
