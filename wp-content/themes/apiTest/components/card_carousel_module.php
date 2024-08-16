<?php
function default_carousel($module)
{
  global $section_count, $options, $wp, $post;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;

  // var_dump($module);
  // die;
?>


  <section class="default-swiper <?php echo $module["custom_class"] ?> <?php echo $module["background_color"] ?>">
    <div class="swiper-container mt-3" data-aos="fade-in">
      <div class="container" data-aos="fade-in">
        <div class="row justify-content-center text-center mb-4">
          <?php if ($module["content"]["content"]) : ?>
            <div class="col-12 col-lg-8 mb-4">
              <?php echo $module["content"]["content"] ?>
            </div>
          <?php endif ?>
          <div class="col-12 d-flex">
            <div class="default-swiper-more d-flex align-items-center">
              <div class="swiper-button-prev mr-2"></div>
              <small class="text-bluegrey"><?php echo $module["indicator_text"] ? $module["indicator_text"]  : 'Slide To See More' ?></small>
              <div class="swiper-button-next ml-2"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-wrapper">
        <?php if ($module["slide"]) : ?>
          <?php foreach ($module["slide"] as $key => $slide) : ?>
            <div class="swiper-slide d-flex h-auto flex-column <?php echo $slide["header"] ? 'bg-white' : '' ?>">
              <div class="card">
                <?php if (isset($slide["image"]["url"])) : ?>
                  <img class="w-100" src="<?php echo $slide["image"]["url"] ?>" alt="<?php echo $slide["image"]["alt"] ?>" />
                <?php endif ?>
                <?php if ($slide["header"]) : ?>
                  <div class="card-content ovh text-center p-3 p-lg-4">
                    <h3><?php echo $slide["header"] ?></h3>
                    <?php if ($slide["text"]) : ?>
                      <p><?php echo $slide["text"] ?></p>
                    <?php endif ?>
                  </div>
                <?php endif ?>
              </div>
            </div>
          <?php endforeach ?>
        <?php endif ?>
      </div>
    </div>
    <?php if ($module["link"]) : ?>
      <div class="container">
        <div class="row text-center mt-4">
          <div class="col-12">
            <?php cta($module["link"], $class = 'btn-arrow') ?>
          </div>
        </div>
      </div>
    <?php endif ?>
    <?php if ($module["disclaimer"]) : ?>
      <div class="container" bis_skin_checked="1">
        <div class="row" bis_skin_checked="1">
          <div class="col-12 col-lg-10 offset-lg-1 cms" bis_skin_checked="1">
            <div class="disclaimer" style="text-align: center;"><em><?php echo $module["disclaimer"] ?></em></div>
          </div>
        </div>
      </div>
    <?php endif ?>
  </section>

<?php
}
?>