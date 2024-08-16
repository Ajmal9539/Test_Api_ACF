<?php
function before_after_photo_grid_module($module)
{
  global $section_count, $options, $wp, $post;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;

?>
	<section class="photo-grid py-4 py-lg-6 <?php echo $module['custom_class'] ?> <?php echo $module['background_color'] ?>">
		<div class="container">

			<?php if ($module["header"]) : ?>
				<div class="row text-center mb-4">
					<div class="col-12">
						<h2><?php echo $module["header"] ?></h2>
					</div>
				</div>
			<?php endif ?>

			<div class="row text-center">
				<?php foreach ($module["item"] as $key => $item) : ?>
					<div class="col-12 col-lg-4 mb-4 ba-wrapper" data-key="<?php echo $section_count . $key ?>">
						<div class="photo-grid-titles d-flex align-items-center justify-content-around bg-grey py-2">
							<h6 class="mb-0 text-white"><?php echo $item["title_left"] ?></h6>
							<h6 class="mb-0 text-white"><?php echo $item["title_right"] ?></h6>
						</div>
						<img class="w-100" src="<?php echo $item["image"]["url"] ?>" alt="<?php echo $item["image"]["alt"] ?>">
						<?php if ($item["image"]["caption"]) : ?>
							<span class="photo-grid-caption"><?php echo $item["image"]["caption"] ?></span>
						<?php endif ?>
					</div>
				<?php endforeach ?>
			</div>

			<?php if ($module["disclaimer"]) : ?>
				<div class="container" bis_skin_checked="1">
					<div class="row" bis_skin_checked="1">
						<div class="col-12 col-lg-10 offset-lg-1 cms" bis_skin_checked="1">
							<div style="text-align: center;"><em><?php echo $module["disclaimer"] ?></em></div>
						</div>
					</div>
				</div>
			<?php endif ?>

			<?php if (count((array) $module["item"]) > 6) : ?>
				<div class="row text-center mt-5">
					<div class="col-12">
						<a href="#" class="btn btn-primary btn-loadmore">Load More</a>
					</div>
				</div>
			<?php endif ?>

		</div>
	</section>
<?php
}
?>