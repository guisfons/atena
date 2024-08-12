<!DOCTYPE html>
<html lang="<?= get_locale(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<?php
		wp_head();

		global $current_user;
		wp_get_current_user();
	?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- Assets -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

	<title><?php echo get_bloginfo('name'); ?> — <?php echo get_the_title(); ?></title>
</head>

<body <?php body_class($post->post_name ?? ''); ?>>
	<header class="header">
		<div class="wrapper header__content">
			<div class="header__superior">
				<a href="<?php echo get_home_url(); ?>" title="<?php echo get_the_title(); ?>">
					<h1 class="header__logo">
						<?php echo get_the_title(); ?>
						<img src="<?php echo esc_url(get_field('logo', 'option')['url']); ?>" alt="<?php echo get_the_title(); ?>">
					</h1>
				</a>
	
				<div class="header__search">
					<?php echo get_search_form(); ?>
				</div>

				<div class="header__language"><?php echo do_shortcode('[custom-language-switcher]'); ?></div>

				<span class="header__mobile"><span></span><span></span><span></span></span>
			</div>
			<nav class="header__menu">
				<?php
				$header_menu = wp_get_nav_menu_items('Menu');

				if (is_array($header_menu)) {
					$menu = array();
					
					foreach ($header_menu as $menu_item) {
						$menu[$menu_item->menu_item_parent][] = $menu_item;
					}

					output_menu(0, $menu);
				}
				?>
			</nav>
		</div>	
	</header>

	<main>