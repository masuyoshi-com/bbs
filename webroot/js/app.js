/*jslint browser :true, continue : true,
  devel  : true, indent : 4,    maxerr   : 50,
  newcap : true, nomen  : true, plusplus : true,
  regexp : true, sloppy : true, vars     : true,
  white  : true
*/
/*global jQuery */
var initRun = (function( $ ) {
    
    'use strict'; 
    
    // 選択されたスレッドセルにchekedを付加
    $('.table-thread tr:has(input)').each(function() {
        $(this).click(function() {
            $(this).find( 'input' ).prop( 'checked', true );
        });
    });
    
    // Datepicker 設定
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function ( selected_date ) {
            $( '#datepicker' ).val( selected_date );
        }
    });
    
    // tr クリックでハイライト
    $('#click-highlight tr').on('click', function() {
        $( '#click-highlight tr' ).removeClass( 'highlight' );
        $(this).toggleClass( 'highlight' );
    });
    
    // ユーザー管理 - trダブルクリックで編集ページへ（リンクはViewで記述）
    $( '.table-user tr[data-href]' ).addClass( 'clickable' ).dblclick(function(e) {
        if ( !$(e.target).is( 'a' ) ) {
          window.location = $( e.target ).closest( 'tr' ).data( 'href' );
        };
    });
    
    // セレクトボックス選択で入力フォームに表示させる
    $( '.fixed-select' ).change(function() {
        var val = $(this).val();
        $( '.select-results' ).val(val);
    });
    
    /**
    * スレッド選択後、ボタンクリックでコメント一覧へ移動する
    * 選択されずにボタンクリックされた場合はエラー
    * 
    * @param {string} build_uri
    * @return void
    */ 
    var clickToCommentIndex = function ( build_uri ) {
        $('#thread_select').click(function() {
            if ( $( '[name=radio]:checked' ).val() !== undefined ) {
                var thread_id = $( '[name=radio]:checked' ).val();
                window.location.href = build_uri + thread_id;
            } else {
                alert( 'スレッドを選択してください。' );
            }
        });
    }
    
    /**
    * スレッド内容取得(AJAX) - 選択されたスレッドの本文を取得するtextareaに表示させる
    *
    * @param {string} build_uri
    * @return void
    */
    var getThread = function( build_uri ) {
        
        $('.table-thread tr').click(function() {
            
            var thread_id = $(this).find( '.thread_id' ).val();
            
            $.ajax({
                url: build_uri,
                type: 'post', 
                dataType: 'json',
                data: {
                    'thread_id': thread_id,
                }
            }).done(function( data ) {
                $( '#text-area' ).val( data );
            }).fail(function( data ) {
                alert( '取得できませんでした。もう一度試してください。' );
            });
        });
    }
    
    /**
    * <tr>ダブルクリックでスレッド編集ページへ
    * ログインユーザとスレッドオーナが違う場合はエラー
    *
    * @param {string} build_uri
    * @return void
    */
    var dblClickToThreadEdit = function ( build_uri ) {
        $('.table-thread tr').dblclick(function() {
            var author_id     = $(this).find( '.author_id' ).val();
            var login_user_id = $( '#login_user_id' ).val();
            var thread_id     = $(this).find( '.thread_id' ).val();
            
            if ( author_id == login_user_id ) {
                window.location.href = build_uri + thread_id;
            } else {
                alert( 'このメッセージのオーナーではありません。' );
            }
        });
    }
    
    /**
    * コメント取得(AJAX) - 選択されたコメント欄の本文を取得。textareaに表示
    * 
    * @param {string} build_uri phpurlヘルパーのビルドURI
    * @return void
    */
    var getComment = function( build_uri ) {
        
        $( '.table-comment tr' ).click(function() {
            
            var comment_id = $(this).find( '.comment_id' ).val();
            
            $.ajax({
                url: build_uri,
                type: 'post', 
                dataType: 'json',
                data: {
                    'comment_id': comment_id,
                }
            }).done(function( data ) {
                $( '#text-comment' ).val( data );
            }).fail(function( data ) {
                alert( '取得できませんでした。もう一度試してください。' );
            });
        });
    }
    
    /**
    * <tr>ダブルクリックでコメント編集ページへ
    * ログインユーザとスレッドオーナが違う場合はエラー
    *
    * @param {string} build_uri phpurlヘルパー
    * @return void
    */
    var dblClickToCommentEdit = function ( build_uri ) {
        $( '.table-comment tr' ).dblclick(function() {
            var author_id     = $(this).find( '.author_id' ).val();
            var comment_id    = $(this).find( '.comment_id' ).val();
            var login_user_id = $( '#login_user_id' ).val();
            var thread_id     = $( '#thread_id' ).val();
            
            if ( author_id === login_user_id ) {
                window.location.href = build_uri + comment_id + '/' + thread_id;
            } else {
                alert( 'このメッセージのオーナーではありません。' );
            }
        });
    }
    
    return {
        getThread  : getThread,
        getComment : getComment,
        dblClickToThreadEdit  : dblClickToThreadEdit,
        dblClickToCommentEdit : dblClickToCommentEdit,
        clickToCommentIndex : clickToCommentIndex
    };
}( jQuery ));
