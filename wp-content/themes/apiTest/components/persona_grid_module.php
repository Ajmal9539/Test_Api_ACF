<?php


function render_persona_grid_module($module)
{
    global $section_count, $wp, $options, $post;
    $site_base_url = strtolower(site_url());
    $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
    $index = 0;
  
?>
    <?= print("<pre>" . print_r($module['item'], true) . "</pre>") ?>

    <section class="mosaic-grid p-0">

        <? if ($module['content']) { ?>
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-12 col-lg-6 offset-lg-3 mb-5 pt-6">
                        <?= $module["content"]["content"] ?>
                    </div>
                </div>
            </div>
        <? } ?>

        <?php foreach ($module['item'] as $item) {

            // var_dump($item);
        }
        ?>
    </section>
<?php
}
