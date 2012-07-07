<?php 
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Colorway
 */
get_header(); ?>
<!--Start Content Grid-->
<div class="grid_24 content">
     <div class="content-wrap">
          <div class="fullwidth">
               <div class="content-info">
                    <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
               </div>
               <h1>
                    <?php _e( 'Not Found', 'colorway' ); ?>
               </h1>
               <p>
                    <?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'colorway' ); ?>
               </p>
               <?php get_search_form(); ?>
          </div>
     </div>
</div>
<div class="clear"></div>
</div>
<?php get_footer(); ?>
