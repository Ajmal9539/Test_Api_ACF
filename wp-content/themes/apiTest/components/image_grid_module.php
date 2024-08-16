<?php
function image_grid_module($module)
{
    global $section_count, $wp, $options, $post;
    $site_base_url = strtolower(site_url());
    $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
    $index = 0;

?>
    <section class="two-image-column">
        <div class="container">
            <h2 class="h2 mb-2 text-center"><?php echo $module['heading'] ?></h2>
            <div class="row">
                <?php foreach ($module['card'] as $card) : ?>
                    <div class="col-12 col-md-6 <?= $card['custom_class'] ?>">
                    <h2 class="h2 mb-1 text-center"><?= $card['heading'] ?></h2>
                        <img class="w-100" src="<?= $card['image'] ?>" alt="<?= $card['alt_text'] ?>">
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php
}
?>