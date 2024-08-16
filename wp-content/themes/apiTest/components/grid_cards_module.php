<?php
function grid_cards_module($module)
{
    global $section_count, $wp, $options, $post;
    $site_base_url = strtolower(site_url());
    $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
    $index = 0;
  
?>
    <?php if ($current_url == $site_base_url . '/management' || $current_url == $site_base_url . '/board-of-directors') : ?>

        <section class="headline-text-two-column pb-0">
            <div class="container">
                <div class="row">
                    <?php if ($module["content"]["content"]) { ?>
                        <div class="col-12 col-lg-10 cms text-center text-lg-left">
                            <?= $module["content"]["content"] ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="team-grid py-4">
            <div class="container">
                <div class="row">
                    <?php foreach ($module['card'] as $index => $card) { ?>
                        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-5">
                            <div class="team-grid-item">
                                <div class="team-grid-img" style="background-image: url(<?= $card["image"]["url"] ?>)" alt="<?= $card["image"]["title"] ?>"></div>
                                <?= $card["content"]["content"] ?>
                                <?php if ($card["content"]["button_group"]) { ?>
                                    <?php button_group($card) ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="team-grid-modal py-5 px-4" id="modal-<?= $index ?>">
                            <div class="modal-content d-md-flex">
                                <?= $card["popup_content"] ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

    <?php endif ?>
<?php
}
