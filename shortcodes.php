<?php
/** 
 * Intro
 *
 */
function intro_shortcode( $atts, $content = null ) {
    return '<h1 class="intro">' . do_shortcode($content) . '<span></span></h1>';
}
add_shortcode( 'intro', 'intro_shortcode' );
/**
 * Columns
 *
 */
/** 2 Columns */
function col2_shortcode( $atts, $content = null ) {
   return '<div class="one_half">'.do_shortcode($content).'</div>';
}
add_shortcode('col2', 'col2_shortcode');
/** 2 Columns Last */
function col2_last_shortcode( $atts, $content = null ) {
    return '<div class="one_half last">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'col2_last', 'col2_last_shortcode' );
/** 3 Columns */
function col3_shortcode( $atts, $content = null ) {
   return '<div class="one_third">'.do_shortcode($content).'</div>';
}
add_shortcode('col3', 'col3_shortcode');
/** 3 Columns Last */
function col3_last_shortcode( $atts, $content = null ) {
    return '<div class="one_third last">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'col3_last', 'col3_last_shortcode' );
/** 4 Columns */
function col4_shortcode( $atts, $content = null ) {
   return '<div class="one_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('col4', 'col4_shortcode');
/** 4 Columns Last */
add_shortcode( 'col4_last', 'col4_last_shortcode' );
function col4_last_shortcode( $atts, $content = null ) {
    return '<div class="one_fourth last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col4_last', 'col4_shortcode');
/** One-Third Columns */
function col1_3_shortcode( $atts, $content = null ) {
   return '<div class="one_third">'.do_shortcode($content).'</div>';
}
add_shortcode('col1_3', 'col1_3_shortcode');
/** One-Third Columns Last */
function col1_3_last_shortcode( $atts, $content = null ) {
   return '<div class="one_third last">'.do_shortcode($content).'</div>';
}
add_shortcode('col1_3_last', 'col1_3_last_shortcode');
/** Two-Third Columns */
function col2_3_shortcode( $atts, $content = null ) {
   return '<div class="two_third">'.do_shortcode($content).'</div>';
}
add_shortcode('col2_3', 'col2_3_shortcode');
/** Two-Third Columns Last */
function col2_3_last_shortcode( $atts, $content = null ) {
   return '<div class="two_third last">'.do_shortcode($content).'</div>';
}
add_shortcode('col2_3_last', 'col2_3_last_shortcode');
/** One-Fourth Columns */
function col1_4_shortcode( $atts, $content = null ) {
   return '<div class="one_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('col1_4', 'col1_4_shortcode');
/** One-Fourth Columns Last */
function col1_4_last_shortcode( $atts, $content = null ) {
   return '<div class="one_fourth last">'.do_shortcode($content).'</div>';
}
add_shortcode('col1_4_last', 'col1_4_last_shortcode');
/** Three-Fourth Columns */
function col3_4_shortcode( $atts, $content = null ) {
   return '<div class="three_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('col3_4', 'col3_4_shortcode');
/** Three-Fourth Columns Last */
function col3_4_last_shortcode( $atts, $content = null ) {
   return '<div class="three_fourth last">'.do_shortcode($content).'</div>';
}
add_shortcode('col3_4_last', 'col3_4_last_shortcode');
?>
