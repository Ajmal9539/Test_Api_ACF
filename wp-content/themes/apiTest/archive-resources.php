<?php
/*
    Template Name: Archive Resources
    Template Post Type: page
*/

global $section_count, $options, $wp, $post;
$site_base_url = strtolower(site_url());
$current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
$index = 0;
// $resources = rinitialize_resource($post = false, $taxes = true);
// var_dump($resources);die;
?>
<?php include __DIR__ . '/head.php'; ?>
<?php include __DIR__ . '/header.php'; ?>

<main>
    <?php include __DIR__ . '/region.php'; ?>

    <?php

    $test_posts = new WP_Query(
        array(
            'post_type'      => 'resources',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => 'in-the-news',
                ),
            ),
        )
    );
    ?>
    <section class="card-grid">
        <div class="container">
            <div class="row cards mt-4 justify-content-center">
                <?php if ($test_posts->have_posts()) : ?>
                    <?php foreach ($test_posts->posts as $resource) : ?>

                        <?php setup_postdata($resource); ?>
                        <div class="col-12 col-lg-4 d-flex mb-4" data-aos="fade-up">
                            <a href="<?php echo esc_url(get_permalink($resource->ID)); ?>" class="card ovh bg-white d-flex flex-column w-100 h-100">
                                <?php if (has_post_thumbnail($resource->ID)) : ?>
                                    <?php $image_url = get_the_post_thumbnail_url($resource->ID, 'full'); ?>
                                    <div class="card-resource-bgimg w-100" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
                                <?php endif; ?>

                                <div class="card-content p-3 p-lg-4 pb-lg-7 flex-grow-1">
                                    <h3><?php echo esc_html($resource->post_title); ?></h3>
                                    <?php if ($resource->post_excerpt) : ?>
                                        <p><?php echo esc_html($resource->post_excerpt); ?></p>
                                    <?php endif; ?>
                                    <span class="btn btn-arrow mt-3 mt-lg-0">Learn More</span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php include __DIR__ . '/footer.php'; ?>

</body>

</html>