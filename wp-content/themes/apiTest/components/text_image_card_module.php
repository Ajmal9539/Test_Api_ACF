<?php

function text_image_card_module($module)
{
    global $section_count, $wp, $options, $post;
    $site_base_url = strtolower(site_url());
    $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
    $index = 0;
?>

    <?php if ($current_url == $site_base_url . '/surgeon-advisory-board') : ?>

        <section class="headline-text-two-column <?= $module['custom_class'] ?> <?= $module['background_color'] ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 cms">
                        <?= $module["heading"] ?>
                        <h4><img loading="lazy" class="wp-image-6294 alignleft" src="<?= $module["image"]["url"] ?>" alt="" width="300" height="300" srcset="<?= $module["image"]["url"] ?>" sizes="(max-width: 300px) 100vw, 300px"><?= $module["sub_heading"] ?></h4>
                        <?= $module["content"]["content"] ?>
                        <?php if ($module["display_disclaimer"]) { ?>
                            <p><?= $module["disclaimer_text"] ?></p>
                        <?php } ?>
                        <?php if (($module["if_button"])) { ?>
                            <?= button_group($module) ?>
                        <?php } ?>

                    </div>
                </div>
            </div>

        </section>

    <?php endif ?>
<?php
}
?>