<?php
include __DIR__ . '/head.php';
include __DIR__ . '/header.php';
?>
<main>
	<section class="container page-not-found">
		<div class="row">
			<div class="col-sm-8 offset-sm-2">
				<h4>Oops! Something went wrong.</h4>
				<p>We can't seems to find the page you're looking for! Please go back to the <a href="<?= $home_url ?>/">homepage</a></p>
			</div>
		</div>
	</section>
</main>
<?php
include __DIR__ . '/footer.php';
?>