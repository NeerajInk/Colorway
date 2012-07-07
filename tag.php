<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * 
 */
 ?>
<?php get_header(); ?>
<!--Start Content Grid-->
<div class="grid_24 content contact">
     <div class="grid_16 alpha">
          <div class="content-wrap">
               <div class="content-info">
                    <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
               </div>
               <div class="blog">
                    <h1>
                         <?php
			printf( __( 'Tag Archives: %s', 'colorway' ), '' . single_tag_title( '', false ) . '' ); ?>
                    </h1>
                    <?php
		/* Run the loop for the tag archive to output the posts
		 * If you want to overload this in a child theme then include a file
		 * called loop-tag.php and that will be used instead.
		 */
		 get_template_part( 'loop', 'tag' );
		?>
               </div>
               <div class="folio-page-info">
                    <!--<label>Page:</label>-->
                    <?php /* Display navigation to next/previous pages when applicable */ ?>
                    <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                    <?php next_posts_link( __( '&larr; Older posts', 'colorway' ) ); ?>
                    <?php previous_posts_link( __( 'Newer posts &rarr;', 'colorway' ) ); ?>
                    <?php endif; ?>
               </div>
          </div>
     </div>
     <?php get_sidebar(); ?>
</div>
<div class="clear"></div>
<!--End Content Grid-->
</div>
<!--End Container Div-->
<?php get_footer(); ?>
