<?php
function linked_list_module($module)
{
  global $section_count, $wp, $options, $post;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;


?>

  <section class="content-linked-list">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6 cms mb-5 mb-lg-0">
          <?= $module["heading"] ?>
          <?= $module["content"]["content"] ?>
          <div class="button-container text-left pb-0">
            <?php if ($module["content"]["button_group"]) { ?>
              <?php button_group($module) ?>
            <?php } ?>
          </div>
        </div>
        <div class="col-12 col-lg-4 offset-lg-1">
        <h3 class="mb-3"><?= $module["title"] ?></h3>
          <div class="list-item-wrapper">

            <?php foreach ($module['list'] as $list) : ?>
              <?php
              // Check if the 'link' key exists in the $list array and if it's an array
              if (isset($list['link']) && is_array($list['link'])) {
                // Output the link array for debugging

                // Iterate over the 'link' array
                foreach ($list['link'] as $link) {
              ?>
                  <a href="<?= $link['url'] ?>" class="linked-list-item" <?php if (!empty($link['target'])) : ?> target="<?= $link['target'] ?>" <?php endif ?>>
                    <img alt="print icon" class="alignnone size-small wp-image-6414" src="<?= $list["icon"] ?>"> <?= $link['title'] ?>
                  </a>
              <?php
                }
              } else {
              }
              ?>
            <?php endforeach; ?>

          </div>
        </div>
      </div>
    </div>
  </section>

<?php
}
?>