<div class="side">
    <h2>sidebar.php使って投稿ページの内容全部表示してみた！</h2>
    <?php /* 取得する投稿の条件 */ ?>
    <?php
        $args = array(
            'post_type' => 'post', /* 取得したい投稿タイプ */
            'posts_per_page' => -1, /* 表示したい投稿の数 (すべての取得したい場合は「-1」) */
        );
        $the_query = new WP_Query($args); /* クエリの作成と発行をし、取得したデータを「$the_query」に格納 */
    ?>

    <?php /* 取得した投稿の表示 */ ?>
    <?php if ($the_query->have_posts()): /* もし、投稿がある場合 */ ?>
    <ul class="list-sidebar">
        <?php while ($the_query->have_posts()) : $the_query->the_post(); /* 投稿のループ開始 */ ?>
        <li>
        <a href="<?php the_permalink(); ?>"><?php /* 投稿のパーマリンク取得 */ ?>

            <div class="post_thumbnail">
                <?php if( has_post_thumbnail() ): /* もし、投稿にサムネイルが設定されている場合 */ ?>
                    <div class="img-sidebar">
                        <?php the_post_thumbnail('thumbnail'); /* 投稿のサムネイルを表示 */ ?>
                    </div>
                <?php else: /* もし、サムネイルが設定されていない場合 */ ?>
                    <div class="img-sidebar">
                        <img src="<?php bloginfo('template_url'); ?>/img/404.jpg" alt="デフォルト画像" />
                    </div>
            <?php endif; /* サムネイルのif文終了 */ ?>
            </div>

            <div class="content-sidebar">
                <p>
                <?php /* 公開日の表示 */ ?>
                <span class="release_date">公開日 | <time datetime="<?php the_time('Y-m-d');?>"><?php the_time('Y.m.d'); ?></time></span>
                <?php /* 最終更新日の表示 */ ?>
                <?php if(get_the_time('Y.m.d') != get_the_modified_date('Y.m.d')): /* もし、公開日(the_time)と最終更新日(the_modified_date)が異なる場合 */ ?>
                <span class="update_date">更新日 | <time datetime="<?php the_modified_date('Y-m-d'); ?>"><?php the_modified_date('Y.m.d'); ?></time></span>
                <?php endif; /* 最終更新日のif文終了 */ ?>
                </p>
                <h2>
                    <?php   /* タイトルン文字数制限*/
                        if(mb_strlen($post->post_title, 'UTF-8')>20){
                            $title= mb_substr($post->post_title, 0, 20, 'UTF-8');
                            echo $title.'……';
                        }else{
                            echo $post->post_title;
                        }
                    ?>
                </h2>
            </div>
        </a>
        </li>
        <?php endwhile; /* 投稿のループ終了 */ ?>
    </ul>
    <?php else: /* もし、投稿がない場合 */ ?>
    <p>まだ投稿がありません。</p>
    <?php endif; /* 投稿の条件分岐を終了 */ ?>
    <?php wp_reset_postdata(); /* クエリ(サブループ)のリセット */ ?>
</div>