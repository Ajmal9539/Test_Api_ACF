<?php
function image_text_four_column($module)
{
  global $section_count, $wp, $options, $post;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;
  
?>
  <section class="text-over-images-grid <?php echo $module["custom_class"] ?> <?php echo $module["gradient"] ?> <?php echo $module["background_color"] ?>">
    <?php if ($module["content"]["content"]) : ?>
      <div class="container">
        <div class="row text-center">
          <div class="col-12 col-lg-6 offset-lg-3 mb-5">
            <?php $module["content"]["content"] ?>

              <!-- if there button  -->
              <?php 
                // Commenting out the code block
                /*
                if ($module["content"]["button_group"]) { 
                ?>
                <div class="button-container">
                  <?= button_group($module) ?>
                </div>
                <?php
                }
                */
              ?>

          </div>
        </div>
      </div>
    <?php endif; ?>


    <div class="container">
      <div class="row text-center">
        <?php foreach ($module["item"] as $item) : ?>
          <div class="col">
            <div class="text-over-images-grid-item d-flex justify-content-center align-items-end h-100" style="background-image: url('<?php echo $item["image"]["url"]; ?>')" data-aos="fade-in">
              <div class="text-over-images-grid-item-content pb-4">
                <?php echo $item["text"]; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>

    <?php if ($module["link"]) : ?>
      <div class="container">
        <div class="row text-center my-4">
          <div class="col-12">
            <?php cta($module["link"], $class = 'btn-arrow') ?>
          </div>
        </div>
      </div>
    <?php endif ?>
  </section>
<?php
}
?>