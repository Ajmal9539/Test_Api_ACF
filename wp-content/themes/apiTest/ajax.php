<?
include('../../../../../wp-load.php');

// CREATE AND MATCH ANY FUNCTIONS FOR AJAX REQUESTS
if ($_REQUEST['fn'] !== 'test') :
	$search = new Search();
	$search->print_json();

endif;
