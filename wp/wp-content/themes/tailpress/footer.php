<?php
include_once 'includes/ContactDescriptionWalker.php';
include_once 'includes/SocialWalker.php';
?>

</main>

<?php do_action('tailpress_content_end'); ?>

</div>

<?php do_action('tailpress_content_after'); ?>

<footer id="colophon" class="site-footer bg-primary" role="contentinfo">
	<?php do_action('tailpress_footer'); ?>

	<div class="container mx-auto flex flex-col justify-center lg:flex-row lg:justify-start items-top primary text-white">
		<div class="area">
			<h3 class="text-3xl"><?= __('General Information', 'tailpress') ?></h3>
			<?php		// General Info
			wp_nav_menu(
				array(
					'container_id'    => 'footer-menu',
					'container_class' => '',
					'menu_class'      => '',
					'theme_location'  => 'footer',
					'li_class'        => 'lg:mx-4',
					'fallback_cb'     => false,
				)
			);
			?>
		</div>

		<div class="area border-y-2 my-4 py-4 lg:border-y-0 lg:my-0 lg:py-0 lg:border-x-2 lg:mx-4 lg:px-4">
			<h3 class="text-3xl"><?= __('Contact', 'tailpress') ?></h3>
		</div>

		<div class="area">
			<h3 class="text-3xl"><?= __('Want to get jobs to whatsapp?', 'tailpress') ?></h3>
		</div>

		<div class="area hidden md:block mr-auto">
			<?php 		// Social Menu
			wp_nav_menu(
				array(
					'container_id'    => 'footer-social',
					'container_class' => 'mt-1 mb-2',
					'menu_class'      => 'flex justify-start gap-3',
					'theme_location'  => 'footer-social',
					'li_class'        => 'px-2 mt-2',
					'walker' => new social_walker,
					'fallback_cb'     => false,
				)
			);
			?>
		</div>
	</div>
	<div class="container mx-auto flex flex-col justify-start text-white mt-8">
		&copy; <?php echo date_i18n('Y'); ?> - <?= _e('All rights reserved to Lev Istitution.', 'lev') ?>
		<div class="text-sm">
			Powered by <a href="https://niloosoft.com/he/">Niloosoft</a> </div>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>