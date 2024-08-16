<?php
$fields = get_fields();
$footer_note = isset($fields["footer_notes"]) ? $fields["footer_notes"] : null;
$display_footer_form = isset($fields["display_footer_form"]) ? $fields["display_footer_form"] : false;
$custom_class = isset($fields["footer_note_custom_class"]) ? $fields["footer_note_custom_class"] : '';
$ri = isset($options["risk_information"]) ? $options["risk_information"] : '';


global $section_count, $wp, $options, $post;
$site_base_url = strtolower(site_url());
$current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
$index = 0;

// var_dump($cri);die;

?>
<?php
if ($footer_note) {
?>
    <section class="headline-text-two-column">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 <?= $custom_class ?> cms">
                    <?= $footer_note ?>
                </div>
            </div>
            <?php
            if ($display_footer_form) { ?>
                <?php if (isset($ri)) : ?>
                    <div class="row mb-3 mb-lg-0 bg-lightbluegrey text-left">
                        <div class="col-12 py-3 px-5 footer-risk-information-content">
                            <?php echo $ri; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php
            }
            ?>

        </div>
    </section>
<?php
}
?>