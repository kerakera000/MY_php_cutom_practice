<!DOCTYPE html>
<html lang="ja" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="format-detection" content="telephone=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		
		<link rel="stylesheet" href="<?php echo get_theme_file_uri('css/style.css'); ?>">
		<link rel="stylesheet" href="style.css">
		<title><?php wp_title(); ?> orage template</title>

    <?php wp_head(); ?>
	</head>
	<body class="body">
		<header>
			<ul class="header-nav">
				<li>
					<h2>ページ遷移だ！</h2>
				</li>
				<li>
					<a href="<?php echo esc_url(home_url('/')); ?>">
						トップに戻る
					</a>
				</li>
				<li>
					<a href="<?php echo esc_url(home_url('/game')); ?>">
						練習用ページ
					</a>
				</li>
			</ul>
		</header>
