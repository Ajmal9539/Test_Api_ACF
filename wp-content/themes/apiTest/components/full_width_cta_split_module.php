<?php 
function fullwidth_cta_split_module($module)
{
	global $section_count, $wp, $options, $post;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;

?>
	<section class="fullwidth-cta-split py-7 py-lg-4 <?php echo $module['custom_class'] ?> <?php echo $module['background_color'] ?>" <?php  if ($module["background_image"]) : ?> style="background-image: url('<?php echo $module["background_image"]["url"] ?>')" <?php  endif ?>>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12 col-lg-5 offset-lg-1 text-center text-lg-left">
					<h2><?php echo $module["headline"] ?></h2>
					<?php  if ($module["text"]) : ?>
						<p><?php echo $module["text"] ?></p>
					<?php  endif ?>
				</div>
				<?php  if ($module["link"]) : ?>
					<div class="col-12 col-lg-5 text-center text-lg-right">
						<?php  cta($module["link"]["link"], $class = 'btn-secondary') ?>
					</div>
				<?php  endif ?>
			</div>
		</div>
	</section>
<?php 
}
?>