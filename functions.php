<?php 

function academics_files() {
    wp_enqueue_style('main_styles', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_script('index-js', get_theme_file_uri('build/index.js'), NULL, 0.1, true);
    // wp_enqueue_style('index-css', get_theme_file_uri('build/index.css'));
    // wp_enqueue_style('style-index-css', get_theme_file_uri('build/style-index.css'));
}

add_action('wp_enqueue_scripts', 'academics_files');

function academy_features() {
    add_theme_support('title-tag');

}

add_action('after_setup_theme', 'academy_features');

function university_adjust_queries($query) {
    if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
} 

add_action('pre_get_posts', 'university_adjust_queries');

function academy_post_types()
{
  // Event Post Type
  register_post_type('event', array(
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => "events"),
    'menu_icon' => 'dashicons-calendar-alt',
    'labels' => array(
      'name' => "Events",
      'all_items' => "All Events",
      'add_new_item' => "Add New Event",
      'edit_item' => "Edit Event",
      'singular_name' => "Event"
    ),
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields',),
  ));

  // Program Post Type
  register_post_type('program', array(
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => "programs"),
    'menu_icon' => 'dashicons-awards',
    'labels' => array(
      'name' => "Program",
      'all_items' => "All Programs",
      'add_new_item' => "Add New Program",
      'edit_item' => "Edit Program",
      'singular_name' => "Program"
    ),
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields',),
  ));

  // Professor Post Type
  register_post_type('professor', array(
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => "professors"),
    'menu_icon' => 'dashicons-welcome-learn-more',
    'labels' => array(
      'name' => "Professor",
      'all_items' => "All Professors",
      'add_new_item' => "Add New Professor",
      'edit_item' => "Edit Professor",
      'singular_name' => "Professor"
    ),
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields',),
  ));

}

add_action('init', 'academy_post_types');
