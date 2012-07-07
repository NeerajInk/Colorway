<div class="grid_8 omega">
     <div class="sidebar">
          <?php
if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
          <?php get_search_form(); ?>
          <h2>
               <?php _e( 'Archives', 'colorway' ); ?>
          </h2>
          <ul>
               <?php wp_get_archives( 'type=monthly' ); ?>
          </ul>
          <h2>
               <?php _e( 'Categories', 'colorway' ); ?>
          </h2>
          <ul>
               <?php wp_list_categories('title_li'); ?>
          </ul>
          <?php endif; // end primary widget area ?>
          <?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
          <?php dynamic_sidebar( 'secondary-widget-area' ); ?>
          <?php endif; ?>
     </div>
</div>
