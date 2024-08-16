<?php

//  Functionalities 
//  @Author :- Ajmal.s
//  @Date   :- 23-04-2024
//  @Time   :- 15:15:15 PM


global $post_objects, $section_count, $post, $wp, $field;
$post_objects = array();
$site_base_url = strtolower(site_url());
$current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));
$template_url = template_url();
$home_url     = base_url();
$upload_url   = upload_url();

function image_variant($module, $name)
{
	foreach ($module[$name]["sizes"] as $image_variant) {
		if (strpos($image_variant, 'http://') !== false || strpos($image_variant, 'https://') !== false) {
			$image_urls[] = $image_variant;
		}
	}
	echo implode(', ', $image_urls);
}

function button_group($module)
{
	global $post;
	foreach ($module["content"]["button_group"] as $button) { ?>
		<a class="<?= $button["button_type"] ?> <?= $button["button_custom_class"] ?>" <?= ($post->post_name == 'management' || $post->post_name == 'board-of-directors') ? 'data-fancybox=""' : '' ?> href="<?= $button["button"]["url"] ?>" target="<?= $button["button"]["target"] ?>"><?= $button["button"]["title"] ?></a>
<?php }
}


// Function for Theme SetUp
function theme_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	register_nav_menus(
		array(
			'primary' => esc_html__('Primary menu', 'puk-menu'),
			'footer'  => __('Secondary menu', 'puk-menu'),
		)
	);

	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));
}

// THEME FUNCTIONS
// THUMBNAILS
add_theme_support('post-thumbnails');
add_theme_support('title-tag');

add_filter('wp_get_attachment_image', 'remove_thumbnail_dimensions', 10, 3);
add_filter('wp_get_attachment_html', 'remove_thumbnail_dimensions', 10, 3);
add_filter('wp_get_attachment_link', 'remove_thumbnail_dimensions', 10, 3);
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10, 3);

function remove_thumbnail_dimensions($html)
{
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}

function image_sizes()
{
	remove_image_size('thumbnail');
	remove_image_size('medium');
	remove_image_size('medium_large');
	remove_image_size('large');

	add_image_size('xs', 100, 999999, false);
	add_image_size('sm', 414, 999999, false);
	add_image_size('md', 768, 999999, false);
	add_image_size('lg', 960, 999999, false);
	add_image_size('xl', 1440, 999999, false);
	add_image_size('xxl', 2440, 999999, false);
}

add_action('init', 'image_sizes');

add_image_size('square-article', 678, 678, array('center', 'center'));
add_image_size('inline-article', 1200, 999999, false);
add_image_size('relational-feature', 768, 512, array('center', 'center'));
add_image_size('full-width-feature', 2048, 842, array('center', 'center'));

// ADDS CUSTOM SIZES TO WP CONTENT
add_filter('image_size_names_choose', 'admin_image_sizes');

function admin_image_sizes($sizes)
{
	return array(
		'xs'		=> __('Small'),
		'md'	=> __('Medium'),
		'lg'	=> __('Large')
	);
}

// ROLES
remove_role('author');
remove_role('contributor');
remove_role('editor');
remove_role('subscriber');

function lazy_srcset($image, $sizes = array('xs', 'sm', 'md', 'lg', 'xl', 'xxl'))
{
	$return = array();
	$dimensions = array();
	foreach ($sizes as $size) :
		// var_dump(is_array( $image ));die;
		if (is_array($image) && isset($image['sizes'][$size])) :
			$dimension = $image['sizes'][$size . '-width'] . 'x' . $image['sizes'][$size . '-height'];
			if (!in_array($dimension, $dimensions)) :
				$return[] = $image['sizes'][$size] . ' ' . $dimension;
				$dimensions[] = $dimension;
			endif;
		elseif (isset($image->sizes->{$size})) :
			$dimension = $image->sizes->{$size . '_width'} . 'x' . $image->sizes->{$size . '_height'};
			if (!in_array($dimension, $dimensions)) :
				$return[] = $image->sizes->{$size} . ' ' . $dimension;
				$dimensions[] = $dimension;
			endif;
		endif;
	endforeach;
	return implode(',', $return);
}
function get_svg( $path )
{
	$template_url = template_url();
	$path = $template_url  . '/assets/images' . $path;
	return file_get_contents( $path );
}

function theme_scripts()
{
	$template_url = template_url();
	wp_enqueue_style('custom-styles', $template_url . '/assets/css/main.min.css', array(), null);
}

add_action('after_setup_theme', 'theme_setup');
add_action('wp_enqueue_scripts', 'theme_scripts');

// ACF THUMBNAILS - REGISTER CSS & JS
add_action('admin_enqueue_scripts', 'acf_flexible_content_thumbnail');

function acf_flexible_content_thumbnail()
{
	$template_url = template_url();
	// REGISTER ADMIN.CSS
	wp_enqueue_style('css-theme-admin', $template_url . '/assets/css/admin.css', false, 1.0);

	// REGISTER ADMIN.JS
	wp_register_script('js-theme-admin', $template_url . '/assets/js/admin.js', array('jquery'), 1.0, true);
	wp_localize_script(
		'js-theme-admin',
		'theme_var',
		array(
			'upload' => $template_url . '/assets/images/acf-thumbnail/',
		)
	);
	wp_enqueue_script('js-theme-admin');
}

function init_options()
{
	global $options;
	// ADD 
	if (function_exists('acf_add_options_page')) :
		acf_add_options_page(array(
			'page_title' 	=> 'Global Settings',
			'menu_title'	=> 'Global Settings',
			'menu_slug' 	=> 'theme-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));

		// SETUP GLOBAL OPTIONS VARIABLE
		$options = get_fields('options');
	endif;
}
add_filter('init', 'init_options');

function get_file_extension($filename)
{
	$filename_pieces = explode('.', $filename);
	$extension = end($filename_pieces);
	return $extension ? $extension : false;
}

// ADD MEDIA TO LIBRARY VIA URL
function upload_to_media_library_from_url($url, $filename, $id = false)
{
	$upload_directory = wp_upload_dir();
	$upload_file = $upload_directory['path'] . '/' . $filename;

	$image_data = file_get_contents($url);
	$savefile = fopen($upload_file, 'w');
	fwrite($savefile, $image_data);
	fclose($savefile);
	add_to_media_library_from_filename($filename, $upload_file, $id);
}

function add_to_media_library_from_filename($filename, $upload_file, $id = false)
{
	global $wpdb;
	include_once(ABSPATH . 'wp-admin/includes/media.php');
	include_once(ABSPATH . 'wp-admin/includes/image.php');

	$media_id = $wpdb->get_var("SELECT `post_id` FROM `wp_postmeta` WHERE `meta_key` = '_wp_attached_file' AND `meta_value` LIKE '%" . $filename . "'");

	if ($media_id) :
		return $media_id;
	endif;

	$wp_filetype = wp_check_filetype(basename($filename), null);

	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => $filename,
		'post_content' => '',
		'post_status' => 'inherit'
	);

	$attach_id = wp_insert_attachment($attachment, $upload_file, $id);

	$new_attachment = get_post($attach_id);
	$fullsizepath = get_attached_file($new_attachment->ID);
	$attach_data = wp_generate_attachment_metadata($attach_id, $fullsizepath);
	wp_update_attachment_metadata($attach_id, $attach_data);

	return $attach_id;
}

function get_csv($file)
{
	$return = [];
	if (($handle = fopen($file, "r")) !== FALSE) :
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) :
			$return[] = $data;
		endwhile;
		fclose($handle);
		return $return;
	endif;
	return $return;
}

function bg_color($color)
{
	echo $color->background_color;
	// var_dump(bg_color($color));die;
}

//----------- URL ShortCodes ------------

// The supported short codes are as follows:

// * [home_url] - the configured blog URL (set in Settings). Eg. http://localhost/wp-test
// * [template_url] - the URL of the active template. Eg. http://localhost/wp-test/wp-content/themes/mytheme
// * [UPLOAD_URL] - the URL of the upload folder. Eg. http://localhost/wp-test/wp-content/uploads


// [home_url] function
function base_url()
{
	return get_bloginfo("url");
}
add_shortcode('home_url', 'base_url');

// [template_url] function
function template_url()
{
	if (get_theme_root_uri() && get_template()) {
		return get_theme_root_uri() . "/" . get_template();
	} else {
		return "";
	}
}
add_shortcode('template_url', 'template_url');

// [UPLOAD_URL] function
function upload_url()
{
	$upload_dir = wp_upload_dir();
	if (!empty($upload_dir['baseurl'])) {
		return $upload_dir['baseurl'];
	} else {
		return "";
	}
}
add_shortcode('UPLOAD_URL', 'upload_url');

// Function to retrieve the menu items from the Main Navigation
function main_mavigation()
{
	// Get the menu items from the "Main Menu" location
	$menu_items = wp_get_nav_menu_items('Main Navigation');

	// Initialize an array to store menu item values
	$menus = array();

	// Check if there are menu items
	if ($menu_items) {
		// Loop through each menu item
		foreach ($menu_items as $menu_item) {
			// Check if the menu item has children (submenu)
			if (!$menu_item->menu_item_parent) {
				// If it's a parent menu item, store it in the main menu array
				$menu = array(
					'title' => $menu_item->title,
					'url' => $menu_item->url,
					'target' => $menu_item->target,
					'submenu' => array(), // Initialize submenu array
				);

				// Get submenu items for this parent menu item
				$submenu_items = get_submenu_items($menu_item->ID, $menu_items);
				// Store submenu items in the 'submenu' key of the main menu array
				if (!empty($submenu_items)) {
					$menu['submenu'] = $submenu_items;
				}

				// Add the menu item to the main menu array
				$menus[] = $menu;
			}
		}
	}

	// Return the main menu item values
	return $menus;
}

// Function to retrieve submenu Navigation
function get_submenu_items($parent_id, $menu_items)
{
	$submenu = array();

	// Loop through each menu item
	foreach ($menu_items as $menu_item) {
		// Check if the current menu item is a child of the parent menu item
		if ($menu_item->menu_item_parent == $parent_id) {
			// Store the submenu item values in the array
			$submenu_item = array(
				'title' => $menu_item->title,
				'url' => $menu_item->url,
				'target' => $menu_item->target,
				// Add more properties as needed
			);

			// Check if the submenu item has children (nested submenu)
			$submenu_item['submenu'] = get_submenu_items($menu_item->ID, $menu_items);

			// Add the submenu item to the array
			$submenu[] = $submenu_item;
		}
	}

	return $submenu;
}

// Function to retrieve the menu items from the Footer Navigation
function footer_navigation()
{
	global $wp;
	$home_url = base_url();
	$current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));

	// Get the menu items from the "Main Menu" location
	if ($current_url == "<?= $home_url ?>/") {
		$menu_items = wp_get_nav_menu_items('Home Footer Navigation');
	}
	$menu_items = wp_get_nav_menu_items('Footer Navigation');


	// Initialize an array to store menu item values
	$menus = array();

	// Check if there are menu items
	if ($menu_items) {
		// Loop through each menu item
		foreach ($menu_items as $menu_item) {
			// Store the menu item values in the array
			$menu = array(
				'title' => $menu_item->title,
				'url' => $menu_item->url,
				'target' => $menu_item->target,
				// Add more properties as needed
			);

			// Check if the menu item has children (submenu)

			// Add the menu item to the array
			$menus[] = $menu;
		}
	}

	// Return the menu item values
	return $menus;
}

function home_footer_navigation()
{
	global $wp;
	$home_url = base_url();
	$current_url = strtolower(home_url(add_query_arg(array(), $wp->request)));

	// Get the menu items from the "Main Menu" location

	$menu_items = wp_get_nav_menu_items('Home Footer Navigation');


	// Initialize an array to store menu item values
	$menus = array();

	// Check if there are menu items
	if ($menu_items) {
		// Loop through each menu item
		foreach ($menu_items as $menu_item) {
			// Store the menu item values in the array
			$menu = array(
				'title' => $menu_item->title,
				'url' => $menu_item->url,
				'target' => $menu_item->target,
				// Add more properties as needed
			);

			// Check if the menu item has children (submenu)

			// Add the menu item to the array
			$menus[] = $menu;
		}
	}

	// Return the menu item values
	return $menus;
}

// Function to retrieve the menu items from the Mobile Navigation
function mobile_navigation()
{
	// Get the menu items from the "Main Menu" location
	$mobile_nav_items = wp_get_nav_menu_items('Mobile Navigation');

	// Initialize an array to store menu item values
	$menus = array();

	// Check if there are menu items
	if ($mobile_nav_items) {
		// Loop through each menu item
		foreach ($mobile_nav_items as $menu_item) {
			// Check if the menu item has children (submenu)
			if (!$menu_item->menu_item_parent) {
				// If it's a parent menu item, store it in the main menu array
				$menu = array(
					'title' => $menu_item->title,
					'url' => $menu_item->url,
					'target' => $menu_item->target,
					'submenu' => array(), // Initialize submenu array
				);

				// Get submenu items for this parent menu item
				$submenu_items = get_submenu_items($menu_item->ID, $mobile_nav_items);
				// Store submenu items in the 'submenu' key of the main menu array
				if (!empty($submenu_items)) {
					$menu['submenu'] = $submenu_items;
				}

				// Add the menu item to the main menu array
				$menus[] = $menu;
			}
		}
	}

	// Return the main menu item values
	return $menus;
}

// Function to retrieve the menu items from the Footer Mobile Navigation
function footer_mobile_navigation()
{
	// Get the menu items from the "Main Menu" location
	$mobile_nav_items = wp_get_nav_menu_items('Footer mobile Navigation');

	// Initialize an array to store menu item values
	$menus = array();

	// Check if there are menu items
	if ($mobile_nav_items) {
		// Loop through each menu item
		foreach ($mobile_nav_items as $menu_item) {
			// Check if the menu item has children (submenu)
			if (!$menu_item->menu_item_parent) {
				// If it's a parent menu item, store it in the main menu array
				$menu = array(
					'title' => $menu_item->title,
					'url' => $menu_item->url,
					'target' => $menu_item->target,
					'submenu' => array(), // Initialize submenu array
				);

				// Get submenu items for this parent menu item
				$submenu_items = get_submenu_items($menu_item->ID, $mobile_nav_items);
				// Store submenu items in the 'submenu' key of the main menu array
				if (!empty($submenu_items)) {
					$menu['submenu'] = $submenu_items;
				}

				// Add the menu item to the main menu array
				$menus[] = $menu;
			}
		}
	}

	// Return the main menu item values
	return $menus;
}

function cta($link, $class = '')
{
	if ($link) : ?>
			<a href="<?= $link["url"] ?>" class="btn <?php if ($class) : ?><?= $class ?><?php endif ?>" target="<?= $link["target"] ?>"><?= $link["title"] ?></a>
	<?php endif;
}

// // ADD OPTIONS PAGE AFTER 'ADVANCED CUSTOM FIELDS PRO' PLUGIN INSTALLED	
// function init_options_page() {
// 	global $options;
// 	// ADD 
// 	if( function_exists( 'acf_add_options_page' ) ) :
// 		acf_add_options_page(array(
// 			'page_title' 	=> 'test_options',
// 			'menu_title'	=> 'test_options',
// 			'menu_slug' 	=> 'theme-settings',
// 			'capability'	=> 'edit_posts',
// 			'redirect'		=> false
// 		));
		
// 		// SETUP GLOBAL OPTIONS VARIABLE
// 		$options = get_fields('options');
// 	endif;
// }	
// add_filter( 'init', 'init_options_page' );


// API TEST

add_action('init', 'api_test');

function api_test()
{
  register_post_type(
    'API TEST',
    array(
      'labels' => array(
        'name' => __('API TEST'),
        'singular_name' => __('API TEST')
      ),
      'menu_icon' => 'dashicons-id',
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'page-attributes')
    )
  );
}

// Include the REST API file
require_once get_stylesheet_directory() . '/Api/rest_api.php';

