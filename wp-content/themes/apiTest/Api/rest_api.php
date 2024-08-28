<?php

// Function to add CORS headers
function add_cors_headers()
{
  $allowed_origin = 'http://localhost/api_test_wp';

  $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

  if ($origin === $allowed_origin) {
    header("Access-Control-Allow-Origin: $allowed_origin");
  } 

  header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
  header("Access-Control-Allow-Credentials: true");
  header("Access-Control-Allow-Headers: Authorization, Content-Type, X-WP-Nonce");
  header("Content-Type: application/json");

  // Handle OPTIONS requests
  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.0 204 No Content");
    exit;
  }
}

// Register REST API routes
add_action('rest_api_init', function () {

  $routes = [
    'GET'    => 'api_get_posts',
    'POST'   => 'api_create_post',
    'DELETE' => 'api_delete_post',
  ];

  $end_point = 'test-api';

  // Register routes for each method
  foreach ($routes as $method => $callback) {
    register_rest_route('api/v2', $end_point, [
      'methods' => $method,
      'callback' => $callback,
      'permission_callback' => function () {
        return is_user_logged_in();
      }
    ]);
  }

  // Add headers for CORS
  add_cors_headers();
});

// Callback function for GET request
function api_get_posts(WP_REST_Request $request)
{
    // Get parameters from the request
    $params = $request->get_params();

    // Set up query arguments
    $args = [
        'post_type' => 'API TEST',
        'posts_per_page' => -1
    ];

    // Filter by ID if provided in the request
    if (isset($params['id'])) {
        $args['p'] = intval($params['id']);
    }

    $query = new WP_Query($args);
    $data = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $api_image_id = get_post_meta(get_the_ID(), 'api_image', true);
            $api_image_url = wp_get_attachment_image_src($api_image_id, 'full');

            $data[] = [
                'id' => get_the_ID(),
                'name' => get_post_meta(get_the_ID(), 'name', true),
                'address' => get_post_meta(get_the_ID(), 'address', true),
                'api_image' => $api_image_url ? $api_image_url[0] : ''
            ];
        }
    }

    wp_reset_postdata();

    // Return response based on data availability
    if (!empty($data)) {
        return new WP_REST_Response(['status' => 200, 'data' => $data], 200);
    } else {
        return new WP_REST_Response(['status' => 404, 'message' => 'No posts found'], 404);
    }
}

// Callback function for POST request
function api_create_post(WP_REST_Request $request)
{
  $parameters = $request->get_params();

  // Check if parameters exist and not empty
  if (empty($parameters['name']) || empty($parameters['address']) || empty($_FILES['api_image'])) {
    return new WP_Error('missing_parameters', 'Missing required parameters', ['status' => 400]);
  }

  $name = sanitize_text_field($parameters['name']);
  $address = sanitize_text_field($parameters['address']);

  // Handle file upload and get the attachment ID
  $file = $_FILES['api_image'];

  // Ensure required WordPress functions are available
  if (!function_exists('wp_handle_upload')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
  }

  $upload = wp_handle_upload($file, ['test_form' => false]);

  if (isset($upload['error']) && !empty($upload['error'])) {
    return new WP_Error('upload_error', 'File upload error: ' . $upload['error'], ['status' => 500]);
  }

  $attachment = [
    'post_mime_type' => $upload['type'],
    'post_title' => sanitize_file_name($upload['file']),
    'post_content' => '',
    'post_status' => 'inherit'
  ];

  $attachment_id = wp_insert_attachment($attachment, $upload['file']);
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
  wp_update_attachment_metadata($attachment_id, $attachment_data);

  // Create the post
  $post_data = [
    'post_title' => $name,
    'post_status' => 'publish',
    'post_type' => 'API TEST'
  ];

  $post_id = wp_insert_post($post_data);

  if (is_wp_error($post_id)) {
    return new WP_Error('error_creating_post', 'Error creating post', ['status' => 500]);
  }

  // Add post meta data
  update_post_meta($post_id, 'name', $name);
  update_post_meta($post_id, 'address', $address);
  update_post_meta($post_id, 'api_image', $attachment_id);

  return new WP_REST_Response(['message' => 'Post created', 'post_id' => $post_id], 201);
}

// Callback function for DELETE request
function api_delete_post(WP_REST_Request $request)
{
  $post_id = (int) $request['id'];

  if (empty($post_id) || !get_post($post_id)) {
    return new WP_Error('invalid_post', 'Invalid post ID', ['status' => 404]);
  }

  // Get the image ID associated with the post
  $api_image_id = get_post_meta($post_id, 'api_image', true);

  // Delete the image if it exists
  if (!empty($api_image_id)) {
    wp_delete_attachment($api_image_id, true);
  }

  // Delete the post and its metadata
  $deleted = wp_delete_post($post_id, true);

  if (!$deleted) {
    return new WP_Error('delete_failed', 'Failed to delete the post', ['status' => 500]);
  }

  return new WP_REST_Response(['message' => 'Post Deleted Successfully.', 'post_id' => $post_id], 200);
}


// File handling 
// function api_handle_file_upload($file, $post_id)
// {
//   // Ensure required WordPress functions are available
//   if (!function_exists('wp_handle_upload')) {
//     require_once(ABSPATH . 'wp-admin/includes/file.php');
//   }
//   if (!function_exists('wp_generate_attachment_metadata')) {
//     require_once(ABSPATH . 'wp-admin/includes/image.php');
//   }
//   if (!function_exists('wp_insert_attachment')) {
//     require_once(ABSPATH . 'wp-admin/includes/media.php');
//   }

//   // Handle the file upload
//   $upload = wp_handle_upload($file, ['test_form' => false]);

//   if (isset($upload['error'])) {
//     return new WP_Error('upload_error', $upload['error'], ['status' => 500]);
//   }

//   // Prepare attachment data
//   $attachment = [
//     'post_mime_type' => $upload['type'],
//     'post_title'     => sanitize_file_name($file['name']),
//     'post_content'   => '',
//     'post_status'    => 'inherit',
//     'post_parent'    => $post_id
//   ];

//   // Insert the attachment
//   $attachment_id = wp_insert_attachment($attachment, $upload['file'], $post_id);

//   if (is_wp_error($attachment_id)) {
//     return $attachment_id;
//   }

//   // Generate and update attachment metadata
//   $attach_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
//   wp_update_attachment_metadata($attachment_id, $attach_data);

//   return $attachment_id;
// }
