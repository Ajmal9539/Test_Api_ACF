<?php
function quiz_module($module)
{

$template_url = template_url();
$home_url     = base_url();
$upload_url   = upload_url();
$menu_items   = main_mavigation();
$mobile_nav_items = mobile_navigation();
global $post, $wp, $options;
$site_base_url = strtolower(site_url());
$current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));

?>
<?php  echo "Quiz Module" ?>
<?php
}
?>