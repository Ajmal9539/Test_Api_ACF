<?php
function centered_content_module($module)
{
    global $section_count, $options, $wp, $post;
    $site_base_url = strtolower(site_url());
    $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
    $index = 0;
  
?>
    <?php if ($current_url == $site_base_url . '/careers') : ?>

        <section class="headline-text-two-column <?= $module["content"]["custom_class"] ?>">
            <div class="container">
                <div class="row">
                    <?= $module["content"]["content"] ?>
                </div>
            </div>
        </section>

    <?php else : ?>

        <?php if ($current_url == $site_base_url . '/privacy-policy') : ?>
            <section class="headline-text bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-4 offset-lg-1">
                            <h2>Privacy Policy</h2>
                        </div>
                    </div>
                </div>
            </section>
            <style>
                .privacy-policy table p {
                    line-height: 1.3;
                    margin-bottom: 0.5rem;
                }

                .privacy-policy table p:last-child {
                    margin-bottom: 0;
                }

                .privacy-policy table td {
                    font-size: 16px;
                    font-weight: 300;
                }

                .privacy-policy ul li {
                    font-size: 16px;
                    font-weight: 300;
                    margin-bottom: 12px;
                    line-height: 1.7;
                    color: #3f3f41;
                }

                #tinymce table tr:nth-child(odd),
                .cms table tr:nth-child(odd) {
                    background-color: #fff;
                }
            </style>
        <?php endif; ?>
        <section class="headline-text-two-column <?= $module["content"]["custom_class"] ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 cms <?= $post->post_name == 'contact' ? 'text-center' : ''  ?>">
                        <?= $module["content"]["content"] ?>
                    </div>
                </div>
            </div>
            <?php if ($current_url == $site_base_url . '/contact') : ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p><small>M1229B</small></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>

    <?php endif; ?>

<?php
}
?>


