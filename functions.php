<?php

include_once TEMPLATEPATH . '/functions/inkthemes-functions.php';
$functions_path = TEMPLATEPATH . '/functions/';
/* These files build out the options interface.  Likely won't need to edit these. */
require_once ($functions_path . 'admin-functions.php');  // Custom functions and plugins
require_once ($functions_path . 'admin-interface.php');  // Admin Interfaces (options,framework, seo)
/* These files build out the theme specific options and associated functions. */
require_once ($functions_path . 'theme-options.php');   // Options panel settings and custom settings
require_once ($functions_path . 'dynamic-image.php');
/* ----------------------------------------------------------------------------------- */
/* Style Enqueue */
/* ----------------------------------------------------------------------------------- */
function colorway_add_style(){
    wp_enqueue_style('colorway-reset', get_template_directory_uri() . "/css/reset.css", '', '', 'all');
    wp_enqueue_style('colorway-text', get_template_directory_uri() . "/css/text.css", '', '', 'all');
    wp_enqueue_style('colorway-960_24_col_responsive', get_template_directory_uri() . "/css/960_24_col_responsive.css", '', '', 'all');    
    wp_enqueue_style('colorway-ddsmooth', get_template_directory_uri() . "/css/ddsmoothmenu.css", '', '', 'all');
    wp_enqueue_style('colorway-coloroptions', get_template_directory_uri() . "/css/".get_option(colorway_altstylesheet).".css", '', '', 'all');
    wp_enqueue_style('colorway-zoombox', get_template_directory_uri() . "/css/zoombox.css", '', '', 'all');
    wp_enqueue_style('colorway-media', get_template_directory_uri() . "/css/media.css", '', '', 'all');
}
add_action('wp_enqueue_scripts','colorway_add_style');
/* ----------------------------------------------------------------------------------- */
/* Custom Jqueries Enqueue */
/* ----------------------------------------------------------------------------------- */
function colorway_custom_jquery(){
    wp_enqueue_script('flexslider', get_template_directory_uri() . "/js/jquery.flexslider-min.js", array('jquery'));
    wp_enqueue_script('mobile-menu', get_template_directory_uri() . "/js/mobile-menu.js", array('jquery'));
}
add_action('wp_footer','colorway_custom_jquery');
/* ----------------------------------------------------------------------------------- */
/* jQuery Enqueue */
/* ----------------------------------------------------------------------------------- */

function jquery_init() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('ddsmoothmenu', get_template_directory_uri() . "/js/ddsmoothmenu.js", array('jquery'));
        wp_enqueue_script('slides', get_template_directory_uri() . '/js/slides.min.jquery.js', array('jquery'));
        wp_enqueue_script('cufonyui', get_template_directory_uri() . '/js/cufon-yui.js', array('jquery'));
        wp_enqueue_script('cufonfont', get_template_directory_uri() . '/js/Champagne.font.js', array('jquery'));
        wp_enqueue_script('tipsy', get_template_directory_uri() . '/js/jquery.tipsy.js', array('jquery'));
        wp_enqueue_script('zoombox', get_template_directory_uri() . '/js/zoombox.js', array('jquery'));
        wp_enqueue_script('validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'));
        wp_enqueue_script('verif', get_template_directory_uri() . '/js/verif.js', array('jquery'));
        wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
    } elseif (is_admin()) {
        
    }
}
add_action('wp_enqueue_scripts', 'jquery_init');
//Front Page Rename
$get_status = get_option('re_nm');
$get_file_ac = TEMPLATEPATH . '/front-page.php';
$get_file_dl = TEMPLATEPATH . '/front-page-hold.php';
//True Part
if ($get_status === 'off' && file_exists($get_file_ac)) {
    rename("$get_file_ac", "$get_file_dl");
}
//False Part
if ($get_status === 'on' && file_exists($get_file_dl)) {
    rename("$get_file_dl", "$get_file_ac");
}
?>