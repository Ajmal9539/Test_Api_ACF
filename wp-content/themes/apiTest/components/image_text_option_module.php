<?php

function text_image_option_module($module)
{
  global $section_count, $wp, $options, $post;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;
  
?>

  <?php if ($module['image_left_or_text_right'] == 'Image Right') : ?>
    <section class="text-image <?= $module['custom_class'] ?> <?= $module["background_color"] ?>">
      <div class="container">
        <div class="row d-flex align-items-center">
          <?php if (!empty($module["content"]["content"])) : ?>
            <div class="col-12 col-lg-6 text-center text-lg-left mb-5 mb-lg-0 cms pr-lg-4" data-aos="fade-in">
              <?= $module["content"]["content"] ?>
            </div>
          <?php endif ?>
          <?php if (!empty($module["image"])) : ?>
            <div class="col-12 col-lg-6" data-aos="fade-in">
              <div class="img-wrapper <?= $module["caption"] ? 'img-overlay' : '' ?>">
                <?php if ($module["video_id"]) : ?>
                  <a href="<?= $module["video_id"] ?>?autoplay=1" data-fancybox> <?php endif ?>
                  <img class="lazy-load w-100" data-lazy-srcset="<?= lazy_srcset($module["image"]) ?>" data-lazy-set="height" alt="<?= $module["image"]["alt"] ?>" />
                  <?php if ($module["caption"]) : ?>
                    <span class="img-caption"><?= $module["caption"] ?></span>
                  <?php endif ?>
                  <?php if ($module["video_id"]) : ?> </a> <?php endif ?>
              </div>
              <?php if ($module["display_disclaimer"] && $module["disclaimer_text"]) : ?>
                <p class="disclaimer-text w-100 text-center mt-2"><small><?= $module["disclaimer_text"] ?></small></p>
              <?php endif ?>
            </div>
          <?php endif ?>
        </div>
      </div>
    </section>
  <?php endif ?>

  <?php if ($module['image_left_or_text_right'] == 'Image Left') : ?>
    <section class="text-image <?= $module['custom_class'] ?> <?= $module["background_color"] ?>">
      <div class="container">
        <div class="row d-flex align-items-center">
          <?php if (!empty($module["image"])) : ?>
            <div class="col-12 col-lg-6 order-2 order-lg-1" data-aos="fade-in">
              <div class="img-wrapper <?= $module["caption"] ? 'img-overlay' : '' ?>">
                <?php if ($module["video_id"]) : ?> <a href="<?= $module["video_id"] ?>?autoplay=1" data-fancybox> <?php endif ?>
                  <img class="lazy-load w-100" data-lazy-srcset="<?= lazy_srcset($module["image"]) ?>" data-lazy-set="height" alt="<?= $module["image"]["alt"] ?>" />
                  <?php if ($module["caption"]) : ?>
                    <span class="img-caption"><?= $module["caption"] ?></span>
                  <?php endif ?>
                  <?php if ($module["video_id"]) : ?> </a> <?php endif ?>
              </div>
              <?php if ($module["display_disclaimer"] && $module["disclaimer_text"]) : ?>
                <p class="disclaimer-text w-100 text-center mt-2 mb-0"><small><?= $module["disclaimer_text"] ?></small></p>
              <?php endif ?>
            </div>
          <?php endif ?>
          <?php if (!empty($module["content"]["content"])) : ?>
            <div class="col-12 col-lg-5 offset-lg-1 text-lg-left text-center mb-4 mb-lg-0 cms order-1 order-lg-2">
              <?= $module["content"]["content"] ?>
            </div>
          <?php endif ?>
        </div>
      </div>
    </section>
  <?php endif ?>

<?php
}
?>