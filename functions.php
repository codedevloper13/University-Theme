<?php

function university_files()
{
    wp_enqueue_script('main-university-js', get_theme_file_uri('/inc/js/scripts-bundled.js'), null, '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('bootstrap', get_theme_file_uri('/inc/css/bootstrap.css'), null, rand(), false);
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('custom-css', get_template_directory_uri() . '/inc/css/custom.css', null, rand(), false);
    //  All Javascript
    wp_enqueue_script('main-university-js', get_theme_file_uri('/inc/js/jquery-3.5.1.js'), null, rand(), true);
    wp_enqueue_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js');
    wp_enqueue_script('main-university-js', get_theme_file_uri('/inc/js/bootstrap.js'), null, rand(), true);
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features()
{
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'university'),
        'footer_menu' => __('Footer Menu', 'university'),
    ));
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'university_features');

/**
 * Add a Footer  sidebar.
 */

function university_footer_sidebar()
{
    register_sidebar(array(
        'name' => __('Footer 1', 'university'),
        'id' => 'footer-1',
        'description' => __('Widgets in this area will be shown on all posts and pages.', 'university'),
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="headline headline--small">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer 2', 'university'),
        'id' => 'footer-2',
        'description' => __('Widgets in this area will be shown on all posts and pages.', 'university'),
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="headline headline--small">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer 3', 'university'),
        'id' => 'footer-3',
        'description' => __('Widgets in this area will be shown on all posts and pages.', 'university'),
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="headline headline--small">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer 4', 'university'),
        'id' => 'footer-4',
        'description' => __('Widgets in this area will be shown on all posts and pages.', 'university'),
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="headline headline--small">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'university_footer_sidebar');
// Paginations

function university_Paginations($pages = '', $range = 2)
{
    $showitems = ($range * 3) + 1;

    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class='pagination'>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
            echo "<a class='hello' href='" . get_pagenum_link(1) . "'>&laquo;</a>";
        }
        if ($paged > 1 && $showitems < $pages) {
            echo "<a class='hello' href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a>";
        }

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<span class='current'>" . $i . '</span>' : "<a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . '</a>';
            }
        }

        if ($paged < $pages && $showitems < $pages) {
            echo "<a class='hello' href='" . get_pagenum_link($paged + 1) . "'>&rsaquo;</a>";
        }
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
            echo "<a class='hello'  href='" . get_pagenum_link($pages) . "'>&raquo;</a>";
        }
        echo '</div>\n';
    }
}

// For url based query check to perform custom query
function university_adjust_query($query)
{
    if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
        $today = date('ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            //'relation' => 'AND',
            array(
                'key' => 'event_date',
                'value' => $today,
                'compare' => '>',
                'type' => 'DATE'

            )
        ));

    }
}

add_action('pre_get_posts', 'university_adjust_query');

// After theme activate automatically past-event page Created...

function university_page_on_theme_activation(){

    // Set the title, template, etc
    $new_page_title     = __('Past Events','university'); // Page's title
    $new_page_content   = '';                           // Content goes here
    $new_page_template  = 'page-past-events.php';       // The template to use for the page
    $page_check = get_page_by_title($new_page_title);   // Check if the page already exists
    // Store the above data in an array
    $new_page = array(
        'post_type'     => 'page',
        'post_title'    => $new_page_title,
        'post_content'  => $new_page_content,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_name'     => 'past-events'
    );
    // If the page doesn't already exist, create it
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

add_action( 'after_switch_theme', 'university_page_on_theme_activation' );

