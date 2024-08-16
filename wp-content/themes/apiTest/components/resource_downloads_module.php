<?php
function resource_downloads_module($module)
{
	global $section_count, $wp, $options, $post;
	$site_base_url = strtolower(site_url());
	$current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
	$index = 0;
?>
	<section class="resource-downloads py-5 <?php echo $module['custom_class'] ?> <?php echo $module['background_color'] ?>">
		<div class="container">

			<?php if ($module["content"]["content"]) : ?>
				<div class="row text-center mb-4">
					<div class="col-12">
						<?php echo $module["content"]["content"] ?>
					</div>
				</div>
			<?php endif ?>

			<div class="row justify-content-center">
				<?php foreach ($module["download_item"] as $download) : ?>

					<?php if ($download["display_video"] == 0) : ?>
						<div class="col-12 col-md-6 col-lg-4 text-center my-2">
							<a class="resource-downloads-item position-relative" href="<?php echo $download["file"]["url"] ?>" target="_blank">
								<img class="img-fluid m-auto d-block" src="<?php echo $download["thumbnail"]["url"] ?>" alt="<?php $download["file"]["title"] ?>">
								<p class="text-darkgrey font-bold mt-3 text-left btn btn-download"><?php echo $download["file"]["title"] ?></p>
							</a>
						</div>

					<?php elseif ($download["display_video"] == 1) : ?>
						<div class="col-12 col-md-6 col-lg-4 text-center my-2">
							<a class="resource-downloads-item resource-downloads-video <?php echo $download["thumbnail"]["width"] > $download["thumbnail"]["height"] ? 'resource-wider' : '' ?>" href="<?php echo $download["video_url"] ?>" data-fancybox>
								<div class="resource-downloads-video-wrapper">
									<img class="img-fluid m-auto" src="<?php echo $download["thumbnail"]["url"] ?>" alt="<?php echo $download["title"] ?>">
								</div>
								<p class="text-darkgrey font-bold mt-3 text-left btn btn-arrow"><?php echo $download["title"] ?> </p>
							</a>
						</div>

					<?php elseif ($download["display_video"] == 2) : ?>
						<div class="col-12 col-md-6 col-lg-4 text-center my-2">
							<a class="resource-downloads-item position-relative <?php echo $download["thumbnail"]["width"] > $download["thumbnail"]["height"] ? 'resource-wider' : '' ?>" href="<?php echo $download["link"]["url"] ?>">
								<img class="img-fluid m-auto d-block" src="<?php echo$download["thumbnail"]["url"] ?>" alt="<?php echo $download["thumbnail"]["alt"] ?>">
								<p class="text-darkgrey font-bold mt-3 text-left"><?php echo $download["link"]["title"] ?> <?php get_svg('btn-text-arrow.svg') ?> </p>
							</a>
						</div>

					<?php endif ?>

				<?php endforeach ?>
			</div>
		</div>
	</section>

<?php
}
