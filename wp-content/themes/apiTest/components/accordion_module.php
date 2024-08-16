<?php
function accordion_module($module)
{
  global $section_count, $wp, $post, $options;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;


?>
  <?php foreach ($module['accordion_block'] as $accordion) : ?>

    <section class="accordion-block py-0 <?= ($accordion['background_color']) ?>" id="<?= ($accordion['anchor_button']) ?>">
      <div class="container-fluid py-4">
        <div class="row text-center">
          <div class="col">
            <h2><?= ($accordion['header']) ?></h2>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10 mb-4">

            <?php foreach ($accordion['accordion_item'] as $item) : ?>
              <div class="accordion-item w-100 my-3 bg-white">
                <div data-tab-item="item-0-<?= $index ?>" class="accordion-header d-flex align-items-center py-4" data-target="#collapse<?= $index ?>">
                  <h4><?= $item['headline'] ?></h4>
                </div>
                <div class="accordion-content" id="item-0-<?= $index ?>">
                  <div class="accordion-body cms">
                    <?= $item['content']['content'] ?>
                  </div>
                </div>
              </div>
              <?php $index++; ?>
            <?php endforeach; ?>

          </div>
        </div>
    </section>

  <?php endforeach ?>

<?php
}
?>