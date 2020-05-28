<?php

require get_theme_file_path('./includes/Notary.php');

//actions :

add_action('wp_enqueue_scripts', 'ddglaw_files');
add_action('wp_enqueue_scripts', 'send_data_to_HTML');
add_action('after_setup_theme', 'ddglaw_features');
add_action('template_redirect', 'check_login_before_notary');

//Filters :

add_filter('login_redirect', 'manage_login',10,3);

function ddglaw_files () {

  //JavaScript files
    // Remember to change microtime to 3.0.0 at the end of developing
    
    wp_deregister_script('jquery');
    wp_enqueue_script( 'jquery','https://code.jquery.com/jquery-3.4.1.slim.min.js',array(),'',true);
    wp_enqueue_script( 'popper','https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(),'',true );
    wp_enqueue_script( 'bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array(),'',true );
    wp_enqueue_script('main-ddglaw-js', get_theme_file_uri('/js/scripts-bundled.js'), array(), microTime(), true);

    //Fontawesome css files
    wp_enqueue_style('ddglaw_fontawesome', '//use.fontawesome.com/releases/v5.8.1/css/all.css');

    //Bootstrap css files
    wp_enqueue_style('ddglaw_bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
    wp_enqueue_style('ddglaw_googlefonts', '//fonts.googleapis.com/css?family=Assistant:200&amp;subset=hebrew');
    wp_enqueue_style('ddglaw_googlefonts1', '//fonts.googleapis.com/css?family=Open+Sans:700');
   
    //Local css file
    wp_enqueue_style('ddglaw_main_styles', get_stylesheet_uri());
}

function send_data_to_HTML() {

  $approvalKindsList = array();

  $approvalKinds = new WP_query (array(
    'post_type' => 'approval_kind',
    'order' => 'ASC',
  ));

  if ($approvalKinds) {
    while ($approvalKinds -> have_posts()) {
      $approvalKinds -> the_post();
      array_push($approvalKindsList, array(
        "id" => get_the_id(),
        "title" => get_the_title(),
      ));
    }
  }
  wp_localize_script('main-ddglaw-js', 'ddglawData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest'),
    'approvalKindsList' => $approvalKindsList
  ));
}

function ddglaw_features () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  add_image_size('partnerLandscape', 400, 260, true);
  add_image_size('partnerPortrait', 350, 300, true);
  add_image_size('pageBanner', 1500, 350, true);
}

function check_login_before_notary () {
  if (is_post_type_archive('notary') AND !is_user_logged_in()) {
    wp_redirect(wp_login_url());
  }
}

function manage_login ($redirectTo, $redirectFrom, $user) {
  return get_post_type_archive_link('notary');
}