<?php 
    add_theme_support('post-thumbnails'); //投稿編集のアイキャッチ設定を表示する内容

    function load_scripts(){

        wp_enqueue_script(
            'mainjs', //名前（なんでも良い）
            get_theme_file_uri( '/js/main.js' ),  //読み込むファイル
            array( 'jquery' ), //jQueryを先に読む
            '', //特にいらない
            true // HTMLの最後で読み込むかどうか 
        );

    }
    add_action( 'wp_enqueue_scripts', 'load_scripts' );
?>