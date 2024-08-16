<?php

function hero_form($module)
{
  global $section_count, $wp, $options, $post;
  $site_base_url = strtolower(site_url());
  $current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
  $index = 0;

  // var_dump($module['hero_height']);die;
?>
  <!--  pop up Starts -->

  <!-- <div id="popupAppointment" data-modal="popupAppointment" class="popup">
    <div class="popContent" id="appointment">

      <button type="button" data-hide="popupAppointment" class="close">
        <svg xmlns="http://www.w3.org/2000/svg" version="1" viewbox="0 0 24 24" width="24px" height="24px">
          <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
        </svg>
      </button>


      <div class="row" style="margin: 0; min-height: 100%">
        <div class="col-lg-5" style="padding: 0; position: relative;">
          <img class="d-none d-lg-block" src="/wp-content/themes/treace/library/dist/images/finda-test-desk.jpg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: 50% 90%;">
          <img class="d-block d-lg-none" src="/wp-content/themes/treace/library/dist/images/finda-test-mob.jpg?v2" style="position: relative; display: block;width: 100%; max-height: 260px; object-fit: cover; object-position: 40% 50%;">
        </div>
        <div class="col-lg-7 hbspt-form" style="padding: 75px;">
          <h1 class="text-center mb-2" style="line-height: 41px;"><?= $module["form_headline"] ?></h1>
          <p class="text-center mb-4" style="margin: auto;"><?= $module["form_subheadline"] ?></p>
          <div data-hubspot-form="c6536b21-18e3-4ee3-974b-97e58271d09f" class="hs-form hs-form--collapse-consent hs-form--placeholders-only"></div>
        </div>
        <div class="col-lg-7" style="padding: 75px;">
          <div class="thank-you text-center cms" style="display:none;">
            <div class="thank-you-inner">
              <h1>Thank you!</h1>
              <p class="mx-auto" style="max-width: 420px;">We will give you a call during normal business hours to help you learn if Lapiplasty<sup>®</sup> 3D Bunion Correction<sup>®</sup> may be right for you.</p>
              <h4 class="mb-3"><strong>Prefer to contact a Lapiplasty<sup>®</sup> Patient Educator directly?</strong></h4>
              <a href="tel:8445002637" class="btn btn-primary">Call 844-500-2637</a>
              <p class="mb-0 mt-4" style="font-size: 14px;">You will receive a confirmation email shortly.</p>
              <p class="mb-0 mt-2" style="font-size: 14px;">M2064C</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!--  pop up End -->
  <section class="hero-form hero-overlay" style="background-image: url(<?= $module["background_image"]["sizes"]["xl"] ?>);">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 form-hero-content">
          <h1><?= $module["headline"] ?></h1>
          <h2><?= $module["subheadline"] ?></h2>
          <ul class="check-list">
            <?php foreach ($module["bullets"] as $bullet) : ?>
              <li><?= $bullet["bullet"] ?></li>
            <?php endforeach ?>

          </ul>
          <!--<div class="text-center text-lg-left mb-3">
						<a class="btn btn-shadow btn btn-shadow--red mr-md-3 mt-3" href="javascript:;" id="openAppointmentPopup">Request Appointment Support</a>
					</div>-->
          <img src="<?php $module["background_image"]["sizes->medium_large"] ?>" alt="<?php $module["background_image"]["alt"] ?>" />
          <div class="mobile-text"><?= $module["mobile_text"] ?></div>
        </div>
        <!-- <div class="col-lg-6 col-xl-5 form-container">
					<div class="form-wrapper">
						<div class="hbspt-form">
							<h3><?= $module["form_headline"] ?></h3>
							<p><?= $module["form_subheadline"] ?></p>
							<div data-hubspot-form="c6536b21-18e3-4ee3-974b-97e58271d09f" class="hs-form hs-form--collapse-consent hs-form--placeholders-only"></div>
						</div>
						<div class="thank-you text-center cms" style="display:none;">
							<div class="thank-you-inner">
								<h1>Thank you!</h1>
								<p class="mx-auto" style="max-width: 420px;">We will give you a call during normal business hours to help you learn if Lapiplasty<sup>®</sup> 3D Bunion Correction<sup>®</sup> may be right for you.</p>
								<h4 class="mb-3"><strong>Prefer to contact a Lapiplasty<sup>®</sup> Patient Educator directly?​</strong></h4>
								<a href="tel:8445002637" class="btn btn-primary">Call 844-500-2637</a>
								<p class="mb-0 mt-4" style="font-size: 14px;">You will receive a confirmation email shortly.</p>
								<p class="mb-0 mt-2" style="font-size: 14px;">M2064C</p>
							</div>
						</div>
					</div>
				</div> -->
      </div>
    </div>
  </section>
<?php
}
?>