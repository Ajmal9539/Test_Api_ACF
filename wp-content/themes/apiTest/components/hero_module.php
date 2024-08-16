<?php
function hero_module($module)
{
	global $post_objects, $section_count, $post, $options, $wp, $field;
	// var_dump($post->post_name == 'careers');die;
	$post_objects = array();

	// Variables
	$site_base_url = strtolower(site_url());
	$current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
?>

	<style>
		#section-0 .hero-bg-image {
			background-position: <?= $module["mobile_background_image_position"] ?>;
		}

		.button-container {
			padding-bottom: 40px;
		}

		@media screen and (min-width: 768px) {
			#section-0 .hero-bg-image {
				background-position: <?= $module["background_image_position"] ?>;
			}

			.button-container {
				padding-bottom: 80px;
			}
		}
	</style>

	<section id="section-0" class="hero d-flex align-items-end align-items-lg-<?= $module["section_position"] ?> <?= $module["custom_class"] ?> <?= $module["hero_height"] == 'regular' ? 'hero-small' : '' ?> <?= $module["hero_overlay"] ? 'hero-overlay' : '' ?> <?= $module["overlay_mob"] ? 'overlay_mob' : '' ?> <?= $module["rotating_images"] ?>" data-aos="fade-in">
		<div class="hero-bg-image <?php echo ($post->post_name == 'careers') ? 'career_banner' : '' ?> lazy-load d-none d-lg-block block" data-lazy-srcset="<?= lazy_srcset($module["background_image"]) ?>" data-lazy-type="background-image"></div>
		<div class="hero-bg-image <?php echo ($post->post_name == 'careers') ? 'career_banner' : '' ?> lazy-load d-lg-none" data-lazy-srcset="<?= lazy_srcset($module["mobile_background_image"]) ?>" data-lazy-type="background-image"></div>
		<div class="container">
			<div class="row text-center text-lg-left">
				<div class="col-12 col-lg-6">
					<div class="hero-content cms" data-aos="fade-up">
						<?php if ($module["content"]["content"]) : ?>
             <?= $module["content"]["content"] ?>
						<?php endif ?>
						<?php if ($module["content"]["button_group"]) : ?>
							<div class="button-container">
								<?= button_group($module) ?>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
			<div class="row hero-caption-wrapper w-100 mx-0">
				<div class="col-12">
					<?php if ($module["hero_caption"] && !$module["rotating_images"]) : ?>
						<span class="hero-caption"><?= $module["hero_caption"] ?></span>
					<?php endif ?>
				</div>
			</div>
		</div>
		<?php if ($module["rotating_images"]) : ?>
			<div class="images-rotate-wrapper d-none d-xl-block">
				<?php foreach ($module["rotating_background_images"] as $image) : ?>
					<div class="image-rotate--single" style="background-image: url('<?= $image["url"] ?>')"></div>
				<?php endforeach ?>
			</div>
			<div class="images-rotate-wrapper d-block d-xl-none">
				<?php foreach ($module["rotating_mobile_background_images"] as $mobileimage) : ?>
					<div class="image-rotate-mobile--single" style="background-image: url('<?= $mobileimage["url"] ?>')"></div>
				<?php endforeach ?>
			</div>
		<?php endif ?>
	</section>
<?php
}
?>