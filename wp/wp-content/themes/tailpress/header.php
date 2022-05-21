<?php
include_once 'includes/SocialWalker.php';
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-gray-900 antialiased'); ?>>

	<?php do_action('tailpress_site_before'); ?>

	<div id="page" class="min-h-screen flex flex-col">

		<?php do_action('tailpress_header'); ?>

		<header class="flex items-center bg-gradient-to-r from-grad-1 via-grad-2 to-grad-3">

			<div class="logo-wrapper">
				<?php if (has_custom_logo()) { ?>
					<div>
						<?php the_custom_logo(); ?>
					</div>
				<?php } else { ?>
					<div class="text-lg uppercase">
						<a href="<?php echo get_bloginfo('url'); ?>" class="font-extrabold text-lg uppercase">
							<?php echo get_bloginfo('name'); ?>
						</a>
					</div>

					<p class="text-sm font-light text-gray-600">
						<?php echo get_bloginfo('description'); ?>
					</p>

				<?php } ?>
			</div>
			<div class="mx-auto container p-0 lg:px-4">
				<div class="flex justify-end lg:justify-between items-center py-2 lg:py-6">
					<?php
					wp_nav_menu(
						array(
							'container_id'    => 'primary-menu',
							'container_class' => 'hidden bg-gray-100 mt-4 mr-10 p-4 lg:mt-0 lg:p-0 lg:bg-transparent lg:block',
							'menu_class'      => 'lg:flex lg:-mx-4',
							'theme_location'  => 'primary',
							'li_class'        => 'text-2xl text-white lg:ml-4 lg:pl-4 border-l-2',
							'fallback_cb'     => false,
						)
					);
					?>

					<?php 		// Social Menu
					wp_nav_menu(
						array(
							'container_id'    => 'header-social',
							'container_class' => 'hidden xl:block mt-12 mr-auto ml-10',
							'menu_class'      => 'flex justify-start gap-2',
							'theme_location'  => 'header-social',
							'li_class'        => 'px-2 mt-2',
							'walker' => new social_walker,
							'fallback_cb'     => false,
						)
					);
					?>

					<div class="flex items-start">
						<img class="object-contain pt-2" src="<?= get_template_directory_uri() . '/images/your-way.png' ?>" alt="" width="40" height="40">
						<div class="text-white px-3 lg:px-5">
							<p class="text-2xl lg:text-4xl font-bold leading-4 lg:leading-6">מרכז<br>קריירה</p>
							<p class="text-xs lg:text-sm leading-4 mt-2">מאקדמיה לתעסוקה<br>בדרך שלך</p>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div id="content" class="site-content flex-grow">

			<?php if (is_front_page()) { ?>
				<!-- Start introduction -->

				<!-- End introduction -->
			<?php } ?>

			<?php do_action('tailpress_content_start'); ?>

			<main>