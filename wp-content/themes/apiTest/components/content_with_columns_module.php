<?php

function content_with_columns_module($module)
{
  global $section_count, $options, $wp, $post;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;

?>
  <section class="content-columns <?php echo $module['background_color'] ?>" data-aos="fade-in">
    <div class="container position-relative content-columns-wrapper">
      <div class="row text-center text-lg-left mb-lg-4 align-items-center">
        <?php if ($module["content"]["content"]) : ?>
          <div class="col-12 col-lg-6 pr-lg-5 pb-4 pb-lg-0 cms d-flex align-items-center" data-aos="fade-in">
            <div class="content cms">
              <?php echo $module["content"]["content"] ?>
              <div class="button-container">
                <div>
                  <?php button_group($module) ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 d-lg-none">
            <p class="mobile-text text-grey px-5 mb-3">Tap To Compare Lapiplasty<sup>&reg;</sup> &amp; <br>
              Osteotomy</p>
          </div>
        <?php endif ?>

        <?php foreach ($module["content_column"] as $column) : ?>
          <div class="col-12 col-lg-3 cms d-none d-lg-block" data-aos="fade-in" data-aos-delay="500">
            <div class="column-item">
              <div class="column-item-top text-center">
                <?php if ($column["header"]) : ?>
                  <h3 class="mb-0"><?php echo $column["header"] ?></h3>
                <?php endif ?>
                <?php if ($column["subtext"]) : ?>
                  <p class="text-darkgrey mb-1"><?php echo $column["subtext"] ?></p>
                <?php endif ?>
              </div>
              <div class="column-item-body">
                <img src="<?php echo $column["image"]["url"] ?>" alt="<?php echo $column["image"]["alt"] ?>">
                <div class="cms text-darkgrey mb-1"><?php echo $column["content"] ?></div>
              </div>
            </div>
          </div>
        <?php endforeach ?>

        <div class="col-12 content-columns-mobile d-lg-none">
          <div class="d-flex align-items-center justify-content-center column-item-tabs">
            <?php foreach ($module["content_column"] as $key => $column) : ?>
              <a href="#" class="d-block column-item-top text-center <?php $key == 0 ? 'active' : '' ?>" data-tab="<?php $key ?>">
                <h3 class="mb-0"><?php echo $column["header"] ?></h3>
                <p><?php echo $column["subtext"] ?></p>
              </a>
            <?php endforeach ?>
          </div>

          <?php foreach ($module["content_column"] as $key => $column) : ?>
            <div class="column-item-body bg-white h-100 <?php echo $key == 0 ? 'active' : '' ?>" data-column="<?php $key ?>">
              <img class="img-fluid" src="<?php echo $column["image"]["url"] ?>" alt="<?php echo $column["image"]["alt"] ?>">
              <div class="cms"><?php echo $column["content"] ?></div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
    <?php if (!empty($module["content"]["button_group"])) : ?>
      <div class="container mt-lg-8">
        <div class="row d-lg-none mt-lg-4">
          <div class="col-12 cms text-center">
            <?php button_group($module) ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

  </section>
<?php
}

?>