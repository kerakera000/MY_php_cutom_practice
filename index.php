<?php get_header(); ?>
<div class="index-box">
    <div class="index-conten">
        <!-- カスタム投稿のお知らせ表示 -->
        <div class="custom-news-cate">
            <?php
                /*指定したタクソノミー、ターム名の取得。表示*/
                $terms = get_terms( 'custom_news_cate', array('slug' => 'custom_news'));
                $term = $terms[0];
                echo '<h2 class="custom-news-h2">'.$term->name.'</h2>';
            ?>
            <?php
                /*選択したタクソノミー の項目取得*/
                $args = array(
                    'post_type' => 'custom_news', //カスタム投稿タイプ名の指定
                    'posts_per_page' => -1, //投稿の取得数の指定
                    'order' => 'DESC',      //投稿の表示順の指定
                    'post_status' => 'publish', //投稿の状態の指定3
                    'tax_query' => array(
                    array(
                        'taxonomy' => 'custom_news_cate',  //カスタムタクソノミー
                        'terms' => array('custom_news'), //カスタムタクソノミーのカテゴリー（タクソノミーターム）
                        'field' => 'slug'
                    ),
                    ),
                );
                $the_query = new WP_Query( $args );

                if ($the_query->have_posts()) {     //
                    while ($the_query->have_posts()) {
                        $the_query->the_post();

                        $title = the_title(NULL, NULL, false);
            ?>

                <div class="custom-news-content">
                    <p class="custom-news-time">
                        <?php the_time('Y.m.d'); ?>
                    </p>
                    <p class="custom-news-title">
                        <a href="<?php echo esc_url(the_permalink()); ?>">
                            <?php echo $title ?>
                        </a>
                    </p>
                </div>

            <?php  }
                } else { ?>
                <p class="news-not-found">News記事がありません。</p>
            <?php  } ?>
            <?php wp_reset_postdata(); /* クエリ(サブループ)のリセット */ ?>
        </div>
        <!-- 投稿ページおすすめ記事三選 -->
        <div class="osusume-post">
            <?php /* 取得する投稿の条件 */ ?>
            <?php
            $args = array(
                'post_type' => 'post', /* 取得したい投稿タイプ */
                'posts_per_page' => 3, /* 表示したい投稿の数 (すべての取得したい場合は「-1」) */
                'post_status' => 'publish',
                'category_name' => 'osusume',
            );
            $osusume = new WP_Query($args); /* クエリの作成と発行をし、取得したデータを「$the_query」に格納 */

            if ($osusume->have_posts()) {
                while ($osusume->have_posts()) {
                    $osusume->the_post();

                    $title = the_title(NULL, NULL, false);
                    $category = get_the_category()[0]; //categoryにカテゴリー格納
                    $cat_slug = $category->slug;       //cat_slugはcategory内にあるslugである
                    $cat_name = $category->name;       //cat_nameはcategory内にあるnameである
            ?>

            <?php  } } else { ?>
                    <p>タイトルなし。</p>
                <?php  } ?>

            <div>
                <h2 class="osusume-title">
                    <?php echo $cat_name ?>
                </h2>
            </div>

            <?php /* 取得した投稿の表示 */ ?>
            <?php if ($osusume->have_posts()): /* もし、投稿がある場合 */ ?>
            <ul class="osusume-content">
                <?php while ($osusume->have_posts()) : $osusume->the_post(); /* 投稿のループ開始 */ ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php /* 投稿のパーマリンク取得 */ ?>
                        <div class="post_thumbnail">
                        <?php if( has_post_thumbnail() ): /* もし、投稿にサムネイルが設定されている場合 */ ?>
                            <?php the_post_thumbnail(); /* 投稿のサムネイルを表示 */ ?>
                        <?php else: /* もし、サムネイルが設定されていない場合 */ ?>
                            <img src="https://placehold.jp/16px/999/ffffff/352x198.png?text=No%20Image" alt="No Image">
                        <?php endif; /* サムネイルのif文終了 */ ?>

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
        <!-- カスタム投稿とカスタムフィールドのプラグインを使ってみた -->
        <div class="seminar-comtent-box">
            <div class="seminar-comtent-text-box">
                <h2>セミナー情報</h2>
                <p>カスタム投稿とカスタムフィールドのプラグインを使ってみた！</p>
            </div>
            <?php
                $args = array(
                    'post_type' => 'seminar', //カスタム投稿タイプ名の指定
                    'posts_per_page' => -1, //投稿の取得数の指定
                );
                $the_query = new WP_Query( $args );
            ?>

            <?php if ( $the_query->have_posts() ): ?>
                <ul>
                    <?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
                        <li>
                            <?php the_post_thumbnail('thumbnail'); ?>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </div>
</div>

<div class="sidebar">
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>