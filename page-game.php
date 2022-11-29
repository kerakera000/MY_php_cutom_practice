<?php
/*
Template Name: game
 */
?>
<!-- ページ作成時WPの固定ページでTemplate Nameと同じ名前のページを作成する -->
<!-- 作らないとページがありませんと表示される -->

<?php get_header(); ?>

<h3 class="p-top-h3">１.ページ遷移練習用に作成</h3>
<h3>ページ作成時WPの固定ページでTemplate Nameと同じ名前のページを作成する</h3>
<h3>作らないとページがありませんとタブに表示される</h3>
<br>
<br>

<h3>投稿のアイキャッチ画像を表示</h3>
<h3>the_post_thumbnail('thumbnail');</h3>
<br>
<br>

<h3>アイキャッチ画像が設定されていない時は決まった画像を表示する。(404指定)</h3>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
    <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('thumbnail'); ?>
    <?php else : ?>
        <img src="<?php bloginfo('template_url'); ?>/img/404.jpg" width="100" height="100" alt="デフォルト画像" />
    <?php endif ; ?>
<?php endwhile; endif; ?>

<h3>投稿ページカテゴリーの一覧表示<h3>

<div class="cat_list">
    <?php
        $categories = get_categories();
        foreach ($categories as $category):
    ?>
    <h2><a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></a></h2>
        <?php
            $my_query = new WP_Query(
                array(
                    'cat' => $category->term_id,
                    'posts_per_page' => 3,
                ));
            if ($my_query->have_posts())://もし
        ?>
            <ul>
            <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
            </ul>
        <?php wp_reset_postdata(); ?>
        <?php else: ?>
        <p>投稿はありません。</p>
    <?php endif; ?>
    <?php endforeach; ?>
</div>

<h3>post内の特定カテゴリーの表示<h3>

<div id="news">
            <?php
            $args = array(
                'posts_per_page' => 3,
                'post_type' => 'post',
                'post_status' => 'publish',
                'category_name' => 'osusume',
            );

            $osusume = new WP_Query($args);

            if ($osusume->have_posts()) {
                while ($osusume->have_posts()) {
                    $osusume->the_post();

                    $title = the_title(NULL, NULL, false);
                    $category = get_the_category()[0]; //categoryにカテゴリー格納
                    $cat_slug = $category->slug;       //cat_slugはcategory内にあるslugである
                    $cat_name = $category->name;       //cat_nameはcategory内にあるnameである
            ?>

                    <a href="<?php echo esc_url(the_permalink()); ?>">
                        <div>
                            <div>
                                <p>
                                    <?php the_time('Y.m.d'); ?>
                                </p>
                            </div>
                            <div>
                                <p class="<?php echo $cat_slug ?> round-p5rem">
                                    <?php echo $cat_name ?>
                                </p>
                            </div>

                            <div>
                                <?php echo $title ?>
                            </div>
                        </div>
                    </a>
                <?php  }
            } else { ?>
                <p>News記事がありません。</p>
            <?php  } ?>
</div>

<h3>カスタムカテゴリーの表示<h3>
<div>
    <?php
        $args = array(
            'post_type' => 'custom_page', //カスタム投稿タイプ名の指定
            'posts_per_page' => -1, //投稿の取得数の指定
            'order' => 'DESC',      //投稿の表示順の指定
            'tax_query' => array(
            array(
                'taxonomy' => 'cstom_item',  //カスタムタクソノミー
                'terms' => array('custom_cate'), //カスタムタクソノミーのカテゴリー（タクソノミーターム）
                'field' => 'slug'
            ),
            ),
        );
        $the_query = new WP_Query( $args );
    ?>

    <?php if ( $the_query->have_posts() ): ?>
        <ul>
            <?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    <?php endif; wp_reset_postdata(); ?>

</div>

<h3>カスタムカテゴリー毎の表示<h3>

<div id="news">
            <?php
            $args = array(
                'post_type' => 'custom_page', //カスタム投稿タイプ名の指定
                'posts_per_page' => -1, //投稿の取得数の指定
                'order' => 'DESC',      //投稿の表示順の指定
                'tax_query' => array(
                array(
                    'taxonomy' => 'cstom_item',  //カスタムタクソノミー
                    'terms' => array('custom_cate'), //カスタムタクソノミーのカテゴリー（タクソノミーターム）
                    'field' => 'slug'
                ),
                ),
            );
            $the_query = new WP_Query( $args );

            if ($the_query->have_posts()) {
                while ($the_query->have_posts()) {
                    $the_query->the_post();

                    $title = the_title(NULL, NULL, false);
                    $taxonomy_slug = array_keys(get_the_taxonomies());
                    $taxonomy = get_taxonomy($taxonomy_slug[0]);//タクソノミー情報取得
                    $taxonomy_name = $taxonomy->label; //タクソノミー名取得
            ?>

                    <a href="<?php echo esc_url(the_permalink()); ?>">
                        <div class="news-item">
                            <div class="news-item-date">
                                <p>
                                    <?php the_time('Y.m.d'); ?>
                                </p>
                            </div>
                            <div class="news-item-category">
                                <p class="<?php echo $cat_slug ?> round-p5rem">
                                    <?php echo $taxonomy_name ?>
                                </p>
                            </div>

                            <div class="news-item-title">
                                <?php echo $title ?>
                            </div>
                        </div>
                    </a>
                <?php  }
            } else { ?>
                <p class="news-not-found">News記事がありません。</p>
            <?php  } ?>
</div>


<h3>カスタムカテゴリー毎の表示2<h3>
<?php
/*タクソノミー 別で選択しtaxonoomy-category.phpに遷移する。*/
    $terms = get_terms('cstom_item');
    foreach ( $terms as $term ) {
        echo '<a class="">'.$term->name.'</a>';
    }
?>
<?php
    /*選択したタクソノミー の項目取得*/
    $args = array(
        'post_type' => 'custom_page', //カスタム投稿タイプ名の指定
        'posts_per_page' => -1, //投稿の取得数の指定
        'order' => 'DESC',      //投稿の表示順の指定
        'tax_query' => array(
        array(
            'taxonomy' => 'cstom_item',  //カスタムタクソノミー
            'terms' => array('custom_cate'), //カスタムタクソノミーのカテゴリー（タクソノミーターム）
            'field' => 'slug'
        ),
        ),
    );
    $the_query = new WP_Query( $args );

    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();

            $title = the_title(NULL, NULL, false);
            $taxonomy_slug = array_keys(get_the_taxonomies());
            $taxonomy = get_taxonomy($taxonomy_slug[0]);//タクソノミー情報取得
            $taxonomy_name = $taxonomy->label; //タクソノミー名取得
    ?>

    <a href="<?php echo esc_url(the_permalink()); ?>">
        <div class="news-item">

            <div class="news-item-title">
                <?php echo $title ?>
            </div>
        </div>
    </a>
    <?php  }
        } else { ?>
        <p class="news-not-found">News記事がありません。</p>
    <?php  } ?>

    <?php get_footer(); ?>
