<?php
global $options, $post, $wp;

$site_base_url = strtolower(site_url());
$current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
$template_url = template_url();
$home_url     = base_url();
$upload_url   = upload_url();
$footer_menu  = footer_navigation();
$footer_mobile_nav = footer_mobile_navigation();
$home_footer_nav   = home_footer_navigation();
$footer_note = isset($fields["footer_notes"]) ? $fields["footer_notes"] : null;
// var_dump($home_url );
// die;
?>

<footer>
	<div class="footer-mobile-nav mobile-nav">
		<ul class="d-lg-none">

			<?php foreach ($footer_mobile_nav as $index => $menu_item) : ?>
				<li class="px-0 <?= !empty($menu_item['submenu']) ? 'has-child' : ''; ?>">
					<a class="font-bold" href="<?= $menu_item['url']; ?>" target="<?= isset($menu_item['target']) ? $menu_item['target'] : '_self'; ?>"><?= $menu_item['title']; ?></a>

					<?php if (isset($menu_item['submenu']) && count($menu_item['submenu']) > 0) : ?>

						<div class="show-submenu" data-menu-target="<?= $index; ?>"></div>
						<div class="mobile-subnav" data-menu="<?= $index; ?>">
							<ul>

								<?php foreach ($menu_item['submenu'] as $submenu_item) : ?>
									<li>
										<a href="<?= $submenu_item['url']; ?>" target="<?= isset($submenu_item['target']) ? $submenu_item['target'] : '_self'; ?>"><?= $submenu_item['title']; ?></a>
									</li>
								<?php endforeach; ?>

							</ul>
						</div>

					<?php endif; ?>

				</li>
			<?php endforeach; ?>

		</ul>
	</div>
	<div class="container-fluid">
		<div class="row d-flex py-lg-4 align-items-center justify-content-around">

			<?php if ($current_url == $site_base_url . '/contact') : ?>
				<div class="col-12 col-lg-3">
					<a href="<?php $home_url ?>" class="d-block"><img class="logo" src="<?php echo $options['footer_logo']['url'] ?>" alt="<?php $options['footer_logo']['alt'] ?>"></a>
				</div>
			<?php else : ?>
				<div class="col-12 col-lg-5 d-flex flex-column flex-lg-row justify-content-center justify-content-lg-start">
					<a href="<?php $home_url ?>" class="d-block"><img class="logo" src="<?php echo $options['footer_logo']['url'] ?>" alt="<?php $options['footer_logo']['alt'] ?>"></a>
					<div class="footer-social d-none d-lg-block ml-lg-4">

						<?php if (isset($options['social']) && is_array($options['social']) && !empty($options['social'])) : ?>
							<?php foreach ($options['social'] as $social) : ?>
								<a href="<?php echo $social['link']['url']; ?>" target="_blank"><img src="<?php echo $social['icon']['url']; ?>" alt=""></a>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($current_url == $home_url) : ?>
				<div class="col-12 col-lg-7 footer-menu py-4 py-lg-0">
					<ul class="d-lg-flex justify-content-lg-end">
						<?php foreach ($home_footer_nav as $menu_item) : ?>
							<li><a href="<?= $menu_item['url'] ?>" target="<?= $menu_item['target'] ?>"><?= $menu_item['title'] ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php else : ?>
				<div class="col-12 col-lg-<?php echo ($post->post_name == 'terms-conditions') ? '7' : '6' ?> footer-menu py-4 py-lg-0">
					<ul class="d-lg-flex justify-content-lg-end">
						<?php foreach ($footer_menu as $menu_item) : ?>
							<li><a href="<?= $menu_item['url'] ?>" target="<?= $menu_item['target'] ?>"><?= $menu_item['title'] ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<div class="footer-social d-lg-none mb-3">
				<?php if (isset($options['social']) && is_array($options['social']) && !empty($options['social'])) : ?>
					<?php foreach ($options['social'] as $social) : ?>
						<a href="<?php echo $social['link']['url']; ?>" target="_blank"><img src="<?php echo $social['icon']['url']; ?>" alt=""></a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center bg-lightgrey text-bluegrey py-2 copyright">
				<p><?php echo $options['copyright'] ?></p>
			</div>
		</div>
	</div>
</footer>

<section id="cookie-consent" class="pl-2 pr-2 pl-lg-5 pr-lg-5">
	<div class="row align-items-center">

		<?php echo $options['cookie_consent'] ?>

		<div class="col-md-3 mt-2 mt-md-0 text-center">
			<button href="<?php echo $options['link']['url']; ?>" class="btn" data-consent-cookies><span><?php echo $options['link']['title'] ?></span></button>
		</div>
	</div>
</section>

<?php wp_footer(); ?>

<script src="<?= $template_url ?>/assets/js/app.js?time=<?= time() ?>" async defer></script>
<script>
	var CONFIG = {};
</script>
<script type="text/javascript" src="https://sidebar.bugherd.com/embed.js?apikey=jj6jxnavpes9iemsqnuxzq" async="true"></script>