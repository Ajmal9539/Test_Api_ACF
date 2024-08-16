<?php
function form_block_module($module)
{
    global $section_count, $options, $wp, $post;
    $site_base_url = strtolower(site_url());
    $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
    $index = 0;
  
?>
    <section class="form-block bg-lightgrey" data-aos="fade-in">
        <div class="container">
            <div class="row align-items-center justify-content-center no-gutters">
                <div class="col-12 col-lg-7 text-center cms">
                    <div class="form-block-content">
                        <?= $module["content"]["content"] ?>
                    </div>
                </div>
                <style>
                    .form-block-content .legal-consent-container .hs-richtext p {
                        font-family: AvenirNextLTPro-Regular, arial, helvetica;
                        font-size: 10px;
                        padding: 10px;
                        font-size: 10px;
                    }
                </style>
                <div class="col-12 col-lg-8 mt-5">
                    <div class="form-block-content">
                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                        <script>
                            hbspt.forms.create({
                                portalId: "7576441",
                                formId: "<?= $module['hubspot_form_id'] ?>"
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
}
