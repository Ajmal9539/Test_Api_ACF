<?php
function headline_text_module($module)
{
	global $section_count, $wp, $options, $post;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;

?>
	<section class="headline-text <?php ($module["custom_class"]) ?> <?php echo $module["background_color"] ?>">
		<div class="container">
			<div class="row">
				<?php if ($module["headline"]) : ?>
					<div class="col-12 col-lg-4 offset-lg-1">
						<h2><?php echo $module["headline"] ?></h2>
					</div>
				<?php endif ?>
				<?php if ($module["content"]["content"]) : ?>
					<div class="col-12 col-lg-6">
						<?php echo $module["content"]["content"] ?>
					</div>
				<?php endif ?>
			</div>
		</div>
	</section>
<?php
}
?>