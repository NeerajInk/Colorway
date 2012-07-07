<?php
/* ----------------------------------------------------------------------------------- */
/* Post Thumbnail Support
/*----------------------------------------------------------------------------------- */
add_theme_support('post-thumbnails');
if (function_exists('add_image_size'))
add_theme_support('post-thumbnails');
if (function_exists('add_image_size')) {
add_image_size('post_thumbnail', 250, 160, true);
}
//Load languages file
load_theme_textdomain('colorway', get_template_directory() . '/languages');
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if (is_readable($locale_file))
require_once($locale_file);
/* ----------------------------------------------------------------------------------- */
/* Auto Feed Links Support
/*----------------------------------------------------------------------------------- */
if (function_exists('add_theme_support')) {
add_theme_support('automatic-feed-links');
}
/* ----------------------------------------------------------------------------------- */
/* Custom Menus Function
/*----------------------------------------------------------------------------------- */
// Add CLASS attributes to the first <ul> occurence in wp_page_menu
function add_menuclass($ulclass) {
return preg_replace('/<ul>/', '<ul class="ddsmoothmenu">', $ulclass, 1);
}
add_filter('wp_page_menu', 'add_menuclass');
add_action('init', 'register_custom_menu');
function register_custom_menu() {
register_nav_menu('custom_menu', __('Main Menu', 'colorway'));
}
function inkthemes_nav() {
if (function_exists('wp_nav_menu'))
wp_nav_menu(array('theme_location' => 'custom_menu', 'container_id' => 'menu', 'menu_class' => 'ddsmoothmenu', 'fallback_cb' => 'inkthemes_nav_fallback'));
else
inkthemes_nav_fallback();
}
function inkthemes_nav_fallback() {
?>
<div id="menu">
<ul class="ddsmoothmenu">
<?php
wp_list_pages('title_li=&show_home=1&sort_column=menu_order');
?>
</ul>
</div>
<?php
}
function get_current_menu() {
if (is_home()) {
print "";
} else {
if (!is_active_sidebar('primary-widget-area') && !is_active_sidebar('secondary-widget-area')) {
print "<li>";
} else {
}
}
}
function new_nav_menu_items($items) {
if (is_home()) {
$homelink = get_current_menu() . '<li class="current_page_item"><a href="' . home_url('/') . '">' . __('Home', 'colorway') . '</a></li>';
} else {
$homelink = get_current_menu() . '<li><a href="' . home_url('/') . '">' . __('Home', 'colorway') . '</a></li>';
}
$items = $homelink . $items;
return $items;
}
add_filter('wp_list_pages', 'new_nav_menu_items');
/* ----------------------------------------------------------------------------------- */
/* Breadcrumbs Plugin
/*----------------------------------------------------------------------------------- */
function inkthemes_breadcrumbs() {
$delimiter = '&raquo;';
$home = 'Home'; // text for the 'Home' link
$before = '<span class="current">'; // tag before the current crumb
$after = '</span>'; // tag after the current crumb
echo '<div id="crumbs">';
global $post;
$homeLink = get_bloginfo('url');
echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
if (is_category()) {
global $wp_query;
$cat_obj = $wp_query->get_queried_object();
$thisCat = $cat_obj->term_id;
$thisCat = get_category($thisCat);
$parentCat = get_category($thisCat->parent);
if ($thisCat->parent != 0)
echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
} elseif (is_day()) {
echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
echo $before . get_the_time('d') . $after;
} elseif (is_month()) {
echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
echo $before . get_the_time('F') . $after;
} elseif (is_year()) {
echo $before . get_the_time('Y') . $after;
} elseif (is_single() && !is_attachment()) {
if (get_post_type() != 'post') {
$post_type = get_post_type_object(get_post_type());
$slug = $post_type->rewrite;
echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
echo $before . get_the_title() . $after;
} else {
$cat = get_the_category();
$cat = $cat[0];
echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
echo $before . get_the_title() . $after;
}
} elseif (!is_single() && !is_page() && get_post_type() != 'post') {
$post_type = get_post_type_object(get_post_type());
echo $before . $post_type->labels->singular_name . $after;
} elseif (is_attachment()) {
$parent = get_post($post->post_parent);
$cat = get_the_category($parent->ID);
$cat = $cat[0];
echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
echo $before . get_the_title() . $after;
} elseif (is_page() && !$post->post_parent) {
echo $before . get_the_title() . $after;
} elseif (is_page() && $post->post_parent) {
$parent_id = $post->post_parent;
$breadcrumbs = array();
while ($parent_id) {
$page = get_page($parent_id);
$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
$parent_id = $page->post_parent;
}
$breadcrumbs = array_reverse($breadcrumbs);
foreach ($breadcrumbs as $crumb)
echo $crumb . ' ' . $delimiter . ' ';
echo $before . get_the_title() . $after;
} elseif (is_search()) {
echo $before . 'Search results for "' . get_search_query() . '"' . $after;
} elseif (is_tag()) {
echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
} elseif (is_author()) {
global $author;
$userdata = get_userdata($author);
echo $before . 'Articles posted by ' . $userdata->display_name . $after;
} elseif (is_404()) {
echo $before . 'Error 404' . $after;
}
if (get_query_var('paged')) {
if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
echo ' (';
echo __('Page', 'colorway') . ' ' . get_query_var('paged');
if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
echo ')';
}
echo '</div>';
}
//* ----------------------------------------------------------------------------------- */
/* Function to call first uploaded image in functions file
 /*----------------------------------------------------------------------------------- */
/**
 * This function thumbnail id and
 * returns thumbnail image
 * @param type $iw
 * @param type $ih 
 */
function inkthemes_get_thumbnail($iw, $ih) {
    $permalink = get_permalink($id);
    $thumb = get_post_thumbnail_id();
    $image = inkthemes_thumbnail_resize($thumb, '', $iw, $ih, true, 90);
    if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
        print "<a href='$permalink'><img class='postimg' src='$image[url]' width='$image[width]' height='$image[height]' /></a>";
    }
}

/**
 * This function gets image width and height and
 * Prints attached images from the post        
 */
function inkthemes_get_image($width, $height) {
    $w = $width;
    $h = $height;
    global $post, $posts;
//This is required to set to Null
    $img_source = '';
    $permalink = get_permalink($id);
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (isset($matches [1] [0])) {
        $img_source = $matches [1] [0];
    }
    $img_path = inkthemes_image_resize($img_source, $w, $h);
    if (!empty($img_path[url])) {
        print "<a href='$permalink'><img src='$img_path[url]' class='postimg' alt='Post Image'/></a>";
    }
}
/* ----------------------------------------------------------------------------------- */
/* Attachment Page Design
/*----------------------------------------------------------------------------------- */
//For Attachment Page
if (!function_exists('twentyten_posted_in')) :
/**
* Prints HTML with meta information for the current post (category, tags and permalink).
*
* @since Twenty Ten 1.0
*/
function twentyten_posted_in() {
// Retrieves tag list of current post, separated by commas.
$tag_list = get_the_tag_list('', ', ');
if ($tag_list) {
$posted_in = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'colorway');
} elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
$posted_in = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'colorway');
} else {
$posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'colorway');
}
// Prints the string, replacing the placeholders.
printf(
$posted_in, get_the_category_list(', '), $tag_list, get_permalink(), the_title_attribute('echo=0')
);
}
endif;
?>
<?php
if (!function_exists('twentyten_comment')) :
/**
* Template for comments and pingbacks.
*
* To override this walker in a child theme without modifying the comments template
* simply create your own twentyten_comment(), and that function will be used instead.
*
* Used as a callback by wp_list_comments() for displaying the comments.
*
* @since Twenty Ten 1.0
*/
function twentyten_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
switch ($comment->comment_type) :
case '' :
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
<div id="comment-<?php comment_ID(); ?>">
<div class="comment-author vcard"> <?php echo get_avatar($comment, 40); ?> <?php printf(__('%s <span class="says">says:</span>', 'colorway'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?> </div>
<!-- .comment-author .vcard -->
<?php if ($comment->comment_approved == '0') : ?>
<em>
<?php _e('Your comment is awaiting moderation.', 'colorway'); ?>
</em> <br />
<?php endif; ?>
<div class="comment-meta commentmetadata"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
<?php
/* translators: 1: date, 2: time */
printf(__('%1$s at %2$s', 'colorway'), get_comment_date(), get_comment_time());
?>
</a>
<?php edit_comment_link(__('(Edit)', 'colorway'), ' '); ?>
</div>
<!-- .comment-meta .commentmetadata -->
<div class="comment-body">
<?php comment_text(); ?>
</div>
<div class="reply">
<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
</div>
<!-- .reply -->
</div>
<!-- #comment-##  -->
<?php
break;
case 'pingback' :
case 'trackback' :
?>
<li class="post pingback">
<p>
<?php _e('Pingback:', 'colorway'); ?>
<?php comment_author_link(); ?>
<?php edit_comment_link(__('(Edit)', 'colorway'), ' '); ?>
</p>
<?php
break;
endswitch;
}
endif;
?>
<?php
/**
* Set the content width based on the theme's design and stylesheet.
*
* Used to set the width of images and content. Should be equal to the width the theme
* is designed for, generally via the style.css stylesheet.
*/
if (!isset($content_width))
$content_width = 590;
?>
<?php
/**
* Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
*
* To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
* function tied to the init hook.
*
* @since Twenty Ten 1.0
* @uses register_sidebar
*/
function twentyten_widgets_init() {
// Area 1, located at the top of the sidebar.
register_sidebar(array(
'name' => __('Primary Widget Area', 'colorway'),
'id' => 'primary-widget-area',
'description' => __('The primary widget area', 'colorway'),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h2 class="widget-title">',
'after_title' => '</h2>',
));
// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
register_sidebar(array(
'name' => __('Secondary Widget Area', 'colorway'),
'id' => 'secondary-widget-area',
'description' => __('The secondary widget area', 'colorway'),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h2 class="widget-title">',
'after_title' => '</h2>',
));
// Area 3, located in the footer. Empty by default.
register_sidebar(array(
'name' => __('First Footer Widget Area', 'colorway'),
'id' => 'first-footer-widget-area',
'description' => __('The first footer widget area', 'colorway'),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
// Area 4, located in the footer. Empty by default.
register_sidebar(array(
'name' => __('Second Footer Widget Area', 'colorway'),
'id' => 'second-footer-widget-area',
'description' => __('The second footer widget area', 'colorway'),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
// Area 5, located in the footer. Empty by default.
register_sidebar(array(
'name' => __('Third Footer Widget Area', 'colorway'),
'id' => 'third-footer-widget-area',
'description' => __('The third footer widget area', 'colorway'),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
// Area 6, located in the footer. Empty by default.
register_sidebar(array(
'name' => __('Fourth Footer Widget Area', 'colorway'),
'id' => 'fourth-footer-widget-area',
'description' => __('The fourth footer widget area', 'colorway'),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action('widgets_init', 'twentyten_widgets_init');
?>
<?php
/**
* Pagination
*
*/
function pagination($pages = '', $range = 2) {
$showitems = ($range * 2) + 1;
global $paged;
if (empty($paged))
$paged = 1;
if ($pages == '') {
global $wp_query;
$pages = $wp_query->max_num_pages;
if (!$pages) {
$pages = 1;
}
}
if (1 != $pages) {
echo "<ul class='paging'>";
if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
echo "<li><a href='" . get_pagenum_link(1) . "'>&laquo;</a></li>";
if ($paged > 1 && $showitems < $pages)
echo "<li><a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a></li>";
for ($i = 1; $i <= $pages; $i++) {
if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
echo ($paged == $i) ? "<li><a href='" . get_pagenum_link($i) . "' class='current' >" . $i . "</a></li>" : "<li><a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a></li>";
}
}
if ($paged < $pages && $showitems < $pages)
echo "<li><a href='" . get_pagenum_link($paged + 1) . "'>&rsaquo;</a></li>";
if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
echo "<li><a href='" . get_pagenum_link($pages) . "'>&raquo;</a></li>";
echo "</ul>\n";
}
}
?>
<?php
// Shortcodes
/**
* Columns
*
*/
/** 2 Columns */
function col2_shortcode($atts, $content = null) {
return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('col2', 'col2_shortcode');
/** 2 Columns Last */
function col2_last_shortcode($atts, $content = null) {
return '<div class="one_half last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col2_last', 'col2_last_shortcode');
/** 3 Columns */
function col3_shortcode($atts, $content = null) {
return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('col3', 'col3_shortcode');
/** 3 Columns Last */
function col3_last_shortcode($atts, $content = null) {
return '<div class="one_third last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col3_last', 'col3_last_shortcode');
/** 4 Columns */
function col4_shortcode($atts, $content = null) {
return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('col4', 'col4_shortcode');
/** 4 Columns Last */
function col4_last_shortcode($atts, $content = null) {
return '<div class="one_fourth last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col4_last', 'col4_last_shortcode');
/** One-Third Columns */
function col1_3_shortcode($atts, $content = null) {
return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('col1_3', 'col1_3_shortcode');
/** One-Third Columns Last */
function col1_3_last_shortcode($atts, $content = null) {
return '<div class="one_third last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col1_3_last', 'col1_3_last_shortcode');
/** Two-Third Columns */
function col2_3_shortcode($atts, $content = null) {
return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('col2_3', 'col2_3_shortcode');
/** Two-Third Columns Last */
function col2_3_last_shortcode($atts, $content = null) {
return '<div class="two_third last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col2_3_last', 'col2_3_last_shortcode');
/** One-Fourth Columns */
function col1_4_shortcode($atts, $content = null) {
return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('col1_4', 'col1_4_shortcode');
/** One-Fourth Columns Last */
function col1_4_last_shortcode($atts, $content = null) {
return '<div class="one_fourth last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col1_4_last', 'col1_4_last_shortcode');
/** Three-Fourth Columns */
function col3_4_shortcode($atts, $content = null) {
return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('col3_4', 'col3_4_shortcode');
/** Three-Fourth Columns Last */
function col3_4_last_shortcode($atts, $content = null) {
return '<div class="three_fourth last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col3_4_last', 'col3_4_last_shortcode');
/*     * Simple Button */
function button_shortcode($atts, $content = null) {
extract(shortcode_atts(array("url" => ''), $atts));
return '<a href="' . $url . '" class="button">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'button_shortcode');
/*     * Big Button */
function big_button_shortcode($atts, $content = null) {
extract(shortcode_atts(array("url" => ''), $atts));
return '<a href="' . $url . '" class="big button">' . do_shortcode($content) . '</a>';
}
add_shortcode('bigbutton', 'big_button_shortcode');
/*     * Pill Button */
function pill_button_shortcode($atts, $content = null) {
extract(shortcode_atts(array("url" => ''), $atts));
return '<a href="' . $url . '" class="pill button">' . do_shortcode($content) . '</a>';
}
add_shortcode('pillbutton', 'pill_button_shortcode');
/*     * Negative Button */
function negative_button_shortcode($atts, $content = null) {
extract(shortcode_atts(array("url" => ''), $atts));
return '<a href="' . $url . '" class="negative button">' . do_shortcode($content) . '</a>';
}
add_shortcode('negativebutton', 'negative_button_shortcode');
/*     * Positive Button */
function positive_button_shortcode($atts, $content = null) {
extract(shortcode_atts(array("url" => ''), $atts));
return '<a href="' . $url . '" class="positive button">' . do_shortcode($content) . '</a>';
}
add_shortcode('positivebutton', 'positive_button_shortcode');
function icon_button_shortcode($atts, $content = null) {
extract(shortcode_atts(array("url" => '', "icon" => ''), $atts));
return '<a href="' . $url . '" class="button"><span class="' . $icon . ' icon"></span>' . do_shortcode($content) . '</a>';
}
add_shortcode('iconbutton', 'icon_button_shortcode');
/////////Theme Options
/* ----------------------------------------------------------------------------------- */
/* Add Favicon
/*----------------------------------------------------------------------------------- */
function childtheme_favicon() {
if (get_option('colorway_favicon') != '') {
echo '<link rel="shortcut icon" href="' . get_option('colorway_favicon') . '"/>' . "\n";
} else {
?>
<link rel="shortcut icon" href="<?php echo bloginfo('template_directory') ?>/images/favicon.ico" />
<?php
}
}
add_action('wp_head', 'childtheme_favicon');
/* ----------------------------------------------------------------------------------- */
/* Show analytics code in footer */
/* ----------------------------------------------------------------------------------- */
function inkthemes_analytics() {
$shortname = get_option('of_shortname');
$output='';
$output = get_option('colorway_analytics');
if ($output <> "")
echo stripslashes($output) ;
}
add_action('wp_head', 'inkthemes_analytics');
/* ----------------------------------------------------------------------------------- */
/* Custom CSS Styles */
/* ----------------------------------------------------------------------------------- */
function of_head_css() {
$custom_css = get_option('colorway_customcss');
$output='';
if ($custom_css <> '') {
$output .= $custom_css . "\n";
}
// Output styles
if ($output <> '') {
$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
echo $output;
}
}
add_action('wp_head', 'of_head_css');
?>