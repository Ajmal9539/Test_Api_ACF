<?php
function text_icon_grid_module($module)
{
    global $section_count, $wp, $options, $post;
    $site_base_url = strtolower(site_url());
    $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
    $index = 0;
    
?>

    <section class="text-icon-grid <?php echo $module["background_color"] ?> <?= ($module["custom_class"]) ?>" data-aos="fade-in">
        <div class="row no-gutters text-center">
            <div class="container">
                <div class="row justify-content-center">

                    <?php foreach ($module['grid_item'] as $grid_item) : ?>
                        <div class="text-icon-grid-item <?= $module["mobile_columns"] == 'two' ? 'col-6' : 'col-10' ?> <?= count((array) $grid_item)  > 3 ? 'col-lg-3' : 'col-lg-4' ?> my-3" data-aos="fade-up" data-aos-delay="300">
                            <?php if (isset($grid_item["icon"]) && $grid_item["icon"]) : ?>
                                <img class="d-inline-block lazy-load w-100 <?= $module["icon_size"] == 'large' ? 'icon-large' : '' ?>" data-lazy-srcset="<?= lazy_srcset($grid_item["icon"]) ?>" data-lazy-set="height" alt="" />
                            <?php endif ?>
                            <?= $grid_item["content"]["content"] ?>
                        </div>
                        <?php if ($grid_item["content"]["button_group"]) { ?>
                            <?= button_group($grid_item) ?>
                        <?php
                        } ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php if ($module["content"]["button_group"]) : ?>
            <div class="button-container">
                <?= button_group($module) ?>
            </div>
            <?php endif ?>
    </section>

<?php
}
?>