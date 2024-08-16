<?php
$template_url = template_url();
$home_url      = base_url();
$upload_url   = upload_url();
// $seo_title = get_field('seo_title');
// var_dump([$seo_title]);die;
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MF9LLHM');
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="DI Labs" />

    <?php wp_head() ?>

    <link rel="stylesheet" href="<?= $template_url ?>/assets/css/app.min.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="<?= $template_url ?>/assets/css/additional.css" type="text/css" media="screen" charset="utf-8">
    <link rel='dns-prefetch' href='//s.w.org' />

    <script type='text/javascript' src='https://www.treace.com/wp-includes/js/jquery/jquery.min.js?ver=3.5.1' id='jquery-core-js'></script>
    <script type='text/javascript' src='https://www.treace.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.3.2' id='jquery-migrate-js'></script>


</head>

<body class="page-template-default page page-id-6301 logged-in">
    <!-- Google Tag Manager (noscript) -->
    <noscript> <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MF9LLHM" height="0" width="0" style="display:none;visibility:hidden"> </iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->