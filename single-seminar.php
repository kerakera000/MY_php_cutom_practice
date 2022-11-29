<?php get_header(); ?>

<div class="seminar-box">
    <?php if( get_field('seminar-image') ): ?>
    <img class="seminar-top-image" src="<?php the_field('seminar-image'); ?>" />
    <?php endif; ?>
    
    <?php $catch_copy = get_field('catch-copy'); ?>
    <h2>キャッチコピー</h2>
    <p><?php echo $catch_copy; ?></p>

    <?php $recomennded_person = get_field('recomennded-person'); ?>
    <h2>当セミナーをお勧めする方</h2>
    <p><?php echo $recomennded_person; ?></p>

    <?php $What_participants_get = get_field('What-participants-get'); ?>
    <h2>当セミナーによって得られるもの</h2>
    <p><?php echo $What_participants_get; ?></p>

    <?php $merit = get_field('merit'); ?>
    <h2>当セミナーに参加するメリット</h2>
    <p><?php echo $merit; ?></p>

    <?php if( get_field('image-teacher') ): ?>
    <img class="seminar-top-image-sub" src="<?php the_field('image-teacher'); ?>" />
    <?php endif; ?>

    <?php $intruduction_of_teacher = get_field('intruduction-of-teacher'); ?>
    <h2>講師紹介</h2>
    <p><?php echo $intruduction_of_teacher; ?></p>

    <?php $contents = get_field('contents'); ?>
    <h2>セミナー内容</h2>
    <p><?php echo $contents; ?></p>

    <?php $date_and_time = get_field('date-and-time'); ?>
    <h2>日時</h2>
    <p><?php echo $date_and_time; ?></p>

    <?php $method = get_field('method'); ?>
    <h2>セミナー方法</h2>
    <p><?php echo $method; ?></p>

    <?php $capacity = get_field('capacity'); ?>
    <h2>定員数</h2>
    <p><?php echo $capacity; ?></p>
</div>

<?php get_footer(); ?>