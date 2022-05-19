<?php
include_once 'includes/ContactDescriptionWalker.php';
include_once 'includes/SocialWalker.php';
?>

</main>

<?php do_action('tailpress_content_end'); ?>

</div>

<?php do_action('tailpress_content_after'); ?>

<footer id="colophon" class="site-footer bg-primary pt-8 pb-4" role="contentinfo">
	<?php do_action('tailpress_footer'); ?>

	<div class="container mx-auto flex flex-col justify-center md:flex-row md:justify-start items-top primary text-white">
		<div class="area">
			<h3 class="text-3xl font-bold mb-6"><?= __('General Information', 'tailpress') ?></h3>
			<?php		// General Info
			wp_nav_menu(
				array(
					'container_id'    => 'footer-menu',
					'container_class' => '',
					'menu_class'      => '',
					'theme_location'  => 'footer',
					'li_class'        => 'text-2xl',
					'fallback_cb'     => false,
				)
			);
			?>
		</div>

		<div class="area text-2xl border-y-2 my-4 py-4 md:border-y-0 md:my-0 md:py-0 md:border-x-2 md:mx-4 md:px-4">
			<h3 class="text-3xl font-bold mb-6"><?= __('Contact', 'tailpress') ?></h3>
			<p><?= __('Message to career center - also Whatsapp', 'tailpress') ?>&nbsp;<a target="_blank" href="tel:026751063">02-6751063</a></p>
			<p><a target="_blank" href="mailto:hasama@jct.ac.il">hasama@jct.ac.il</a></p>
		</div>

		<div class="area text-2xl">
			<h3 class="text-3xl font-bold mb-6"><?= __('Want to get jobs to whatsapp?', 'tailpress') ?></h3>
			<p><?= __('Send us whatsapp with your area of study and we will send you a link', 'tailpress') ?></p>
			<p><a target="_blank" href="https://wa.me/+97226751063">02-6751063</a></p>
		</div>

		<div class="area text-2xl hidden md:block mr-auto">
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
		&copy; <?php echo date_i18n('Y'); ?> - <?= _e('All rights reserved to Lev Istitution.', 'tailpress') ?>
		<div class="text-sm">
			Powered by <a target="_blank" href="https://niloosoft.com/he/">Niloosoft</a> </div>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>